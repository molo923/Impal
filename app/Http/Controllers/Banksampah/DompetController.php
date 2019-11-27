<?php

namespace App\Http\Controllers\Banksampah;

use App\BankAccount;
use App\Banksampah;
use App\Notifications\BanksampahMakePayment;
use App\Notifications\BanksampahPaymentDone;
use App\Setoran;
use App\SetoranPayment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DompetController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', SetoranPayment::class);

        $setorans = Setoran::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->whereHas('nasabah')
            ->where('status_id', config('constants.statuses.SELESAI'))
            ->doesntHave('setoranPayment')
            ->get();

        $setoranPayments = Setoran::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->whereHas('setoranPayment', function ($query) {
                $query->where('status_id', config('constants.statuses.MENUNGGUPEMBAYARAN'));
            })
            ->with(['setoranPayment'])
            ->get();

        $setoranPaymentsConfirmed = Setoran::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->whereHas('setoranPayment', function ($query) {
                $query->where('status_id', config('constants.statuses.BELUMKONFIRMASI'));
            })
            ->with(['setoranPayment'])
            ->get();

        $setoranPaymentsDone = Setoran::whereHas('banksampah', function ($query) {
            $query->where('banksampah_id', banksampah()->id);
        })
            ->whereHas('setoranPayment', function ($query) {
                $query->where('status_id', config('constants.statuses.SELESAI'));
            })
            ->with(['setoranPayment'])
            ->get();

        $bankAccounts = BankAccount::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->get();

        $doneNotif = banksampah()->unreadNotifications->filter(function ($item) {
            return isset($item->data['type']) && $item->data['type'] === 'setoran_payment' && $item->data['status'] === config('constants.statuses.SELESAI');
        });

        banksampah()->unreadNotifications->map(function ($item) {
            if (isset($item->data['type']) && $item->data['type'] === 'setoran_payment' && $item->data['status'] === config('constants.statuses.SELESAI')) {
                $item->markAsRead();
            }
        });

        return view('banksampah.dompet.index', [
            'title' => 'Dompet',
            'setorans' => $setorans,
            'setoran_payments' => $setoranPayments,
            'setoran_payments_confirmed' => $setoranPaymentsConfirmed,
            'setoran_payments_done' => $setoranPaymentsDone,
            'bankaccounts' => $bankAccounts,
            'done_notif' => $doneNotif,
        ]);
    }

    public function payNasabah(Request $request)
    {
        $setoran_payment = SetoranPayment::create([
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'date_placed' => now(),
            'ovo_number' => $request->ovo_number,
            'bank_account_id' => $request->bank_account,
            'status_id' => config('constants.statuses.MENUNGGUPEMBAYARAN'),
        ]);

        $setoran_payment->setoran()->associate($request->setoran_id);

        $setoran_payment->save();

        return redirect(route('dompet.index'));
    }

    /*public function transaction()
    {
        return view('banksampah.dompet.pembayaran', [
            'title' => 'Detail pembayaran nasabah',
        ]);
    }*/

    public function paymentList()
    {
        $setorans = Setoran::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->whereHas('setoranPayment', function ($query) {
                $query->where('status_id', config('constants.statuses.MENUNGGUPEMBAYARAN'));
            })
            ->with(['setoranPayment'])
            ->get();

        $bankAccounts = BankAccount::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->get();

        return view('banksampah.dompet.payment-list', [
            'title' => 'Menunggu Pembayaran',
            'setorans' => $setorans,
            'bankaccounts' => $bankAccounts,
        ]);
    }

    /*public function uploadProof(Request $request, $id)
    {
        $request->file('file')->store('assets');

        $setoran_payment = SetoranPayment::find($id);
    }*/

    public function paymentConfirm(Request $request, $id)
    {
        $setoran_payment = SetoranPayment::find($id);

        $setoran_payment->update([
            'date_confirmed' => now(),
            'description' => $request->description,
            'status_id' => config('constants.statuses.BELUMKONFIRMASI'),
        ]);

        banksampah()->unreadNotifications->map(function ($item) use ($setoran_payment) {
            if ($item->data['setoran_id'] === $setoran_payment->setoran->id) {
                $item->markAsRead();
            }
        });

        $admin = User::where('username', 'admin')->get()->first();

        $admin->notify(new BanksampahMakePayment($setoran_payment));

        return redirect(route('dompet.index'));
    }
}
