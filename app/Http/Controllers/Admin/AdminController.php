<?php

namespace App\Http\Controllers\Admin;

use App\Banksampah;
use App\Notifications\BanksampahActivated;
use App\Notifications\BanksampahPaymentDone;
use App\Setoran;
use App\SetoranPayment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Admin';

        $banksampahs = Banksampah::whereHas('user', function ($query) {
                $query->whereNotNull('email_verified_at')
                    ->whereNull('activated_at');
            })
            ->get();

        $setoranPayments = SetoranPayment::where('status_id', config('constants.statuses.BELUMKONFIRMASI'))
            ->with(['Setoran'])
            ->get();

        $banksampahNonactiveCount = Banksampah::countNonactive();
        $usersCount = User::where('username', '!=', 'admin')->count();
        $setoranPaymentsCount = SetoranPayment::where('status_id', config('constants.statuses.BELUMKONFIRMASI'))
            ->with(['Setoran'])->count();

        return view('admin.index', compact(
            'title', 'banksampahs', 'setoranPayments', 'banksampahNonactiveCount', 'usersCount', 'setoranPaymentsCount'));
    }

    public function accounts()
    {
        $users = User::where('username', '!=' ,'admin')->get()->sortByDesc('created_at');

        return view('admin.accounts', [
            'users' => $users,
        ]);
    }

    public function wallet()
    {
        $setoranPayments = SetoranPayment::where('status_id', config('constants.statuses.BELUMKONFIRMASI'))
            ->with(['Setoran'])
            ->get();

        $setoranPaymentsDone = SetoranPayment::where('status_id', config('constants.statuses.SELESAI'))
            ->with(['Setoran'])
            ->get();

        return view('admin.wallet', [
            'title' => 'Pembayaran Bank Sampah',
            'setoran_payments' => $setoranPayments,
            'setoran_payments_done' => $setoranPaymentsDone,
        ]);
    }

    public function banksampah()
    {
        $title = 'Bank Sampah';
        $banksampahs = Banksampah::whereHas('user', function ($query) {
                $query->whereNotNull('email_verified_at')
                    ->whereNull('activated_at');
            })
            ->get();

        return view('admin.banksampah', compact('title','banksampahs'));
    }

    public function banksampahConfirm($id)
    {
        $banksampah = Banksampah::find($id);

        $banksampah->user()->update([
            'status_id' => config('constants.statuses.AKTIF'),
            'activated_at' => now(),
        ]);

        $banksampah->user->notify(new BanksampahActivated);

        return redirect()->back()->with('status', 'Berhasil mengaktifkan Bank Sampah');
    }

    public function toggleUserStatus($id)
    {
        $user = User::find($id);

        $status = $user->status_id === config('constants.statuses.AKTIF')
            ? config('constants.statuses.NONAKTIF')
            : config('constants.statuses.AKTIF');

        $user->status_id = $status;

        // For development
        $user->email_verified_at = $user->status_id === config('constants.statuses.AKTIF') ? now() : null;

        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengaktifkan akun');
    }

    public function paymentReceived(Request $request, $id)
    {
        $setoran_payment = SetoranPayment::find($id);

        $setoran_payment->update([
            'date_done' => now(),
            'status_id' => config('constants.statuses.SELESAI'),
        ]);

        $banksampah = Banksampah::find($setoran_payment->setoran->banksampah->id);

        $banksampah->notify(new BanksampahPaymentDone($setoran_payment));

        auth()->user()->unreadNotifications->map(function ($item) use ($setoran_payment) {
            if (isset($item->data['id']) && isset($item->data['status']) && $item->data['id'] === $setoran_payment->id && $item->data['status'] === config('constants.statuses.BELUMKONFIRMASI')) {
                $item->markAsRead();
            }
        });

        return redirect()->back()->with('success', 'Berhasil menerima pembayaran');
    }
}
