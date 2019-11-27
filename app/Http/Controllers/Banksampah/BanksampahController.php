<?php

namespace App\Http\Controllers\Banksampah;

use App\Alamat;
use App\BankAccount;
use App\Driver;
use App\Http\Requests\NasabahRequest;
use App\Jadwal;
use App\Kategorisampah;
use App\Nasabah;
use App\Pegawai;
use App\Http\Controllers\Controller;
use App\Setoran;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class BanksampahController extends Controller
{
    public function index()
    {
        $kategorisampahs = Kategorisampah::whereHas('banksampahKategorisampah', function ($query) {
            $query->whereNotNull('price_rec');
        })->with('banksampahKategorisampah')->get();

        return view('banksampah.index', [
            'kategorisampahs' => $kategorisampahs,
        ]);
    }

    public function profile()
    {
        return view('banksampah.account-settings.profile', [
            'title' => 'Profil',
        ]);
    }

    public function profileEdit()
    {
        return view('banksampah.account-settings.profile-edit', [
            'title' => 'Edit Profil',
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();

        if (auth()->user()->banksampah) {
            $user->banksampah()->update([
                'name' => $request->name,
            ]);
        }

        return redirect()->back()->with('status', 'Berhasil menyunting profil');
    }

    public function accountEdit()
    {
        return view('banksampah.account-settings.edit', [
            'title' => 'Edit Akun',
        ]);
    }

    public function accountUpdate(Request $request)
    {
        $user = auth()->user();

        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return redirect()->back()->with('status', 'Berhasil menyunting akun');
    }

    public function passwordEdit()
    {
        return view('banksampah.account-settings.password-edit', [
            'title' => 'Ubah Password',
        ]);
    }

    public function passwordUpdate(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'password_old' => 'required|current_password',
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[0-9])(?=.*[\d\X]).*$/'],
        ],[
            'password_old.current_password' => 'Kata sandi yang anda masukkan tidak sesuai.'
        ], [
            'password_old' => 'Kata sandi lama',
            'password' => 'Kata sandi baru'
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('status', 'Berhasil menyunting password');
    }

    public function nasabahIndex()
    {
        $this->authorize('viewAny', Nasabah::class);

        $api = new \GuzzleHttp\Client();
        $token = $api->request('GET', 'https://x.rajaapi.com/poe');
        $response = $api->request('GET', 'https://x.rajaapi.com/MeP7c5ne' . json_decode($token->getBody())->token . '/m/wilayah/kabupaten?idpropinsi=32');

        $kotas = json_decode($response->getBody());

        return view('banksampah.nasabah-index', [
            'title' => 'Nasabah',
            'nasabahs' => Nasabah::whereHas('banksampahs', function($query) {
                $query->where('banksampah_id', banksampah()->id);
            })->with('user')->get(),
            'kotas' => $kotas->data,
        ]);
    }

    public function nasabahShow($nasabahId)
    {
        $nasabah = Nasabah::find($nasabahId);

        return view('banksampah.nasabah-detail', [
            'title' => $nasabah->name,
            'nasabah' => $nasabah
        ]);
    }

    public function nasabahStore(NasabahRequest $request)
    {
        $user = User::create([
            'phone_number' => $request->phone_number,
            'status_id' => config('constants.statuses.AKTIF'),
        ]);

        $alamat = Alamat::create([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'districts' => $request->districts,
            'urban' => $request->urban,
        ]);

        $alamat->user()->save($user);

        $nasabah = $user->nasabah()->create($request->only(['name', 'gender']));

        $nasabah->banksampahs()->attach(Auth::user()->banksampah, [
            'status_id' => config('constants.statuses.NONAKTIF'),
        ]);

        return redirect()->back();
    }

    public function toggleStatus($nasabah)
    {
        /*$this->authorize('update', Nasabah::class);*/

        $nasabah = Nasabah::find($nasabah);
        $banksampah = banksampah();
        $setoranNasabah = Setoran::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->where('nasabah_id', $nasabah->id)
            ->where('status_id', config('constants.statuses.DIPROSES'))
            ->get();

        if ($setoranNasabah->isNotEmpty()) {
            return redirect()->back()->with('danger', 'Nasabah masih memiliki setoran yang belum selesai, harap selesaikan setoran sebelum menonaktifkan nasabah.');
        }

        $status_id = $nasabah->jadwal()->status_id === config('constants.statuses.NONAKTIF')
            ? config('constants.statuses.AKTIF')
            : config('constants.statuses.NONAKTIF');

        $msg = $status_id === config('constants.statuses.AKTIF') ? 'mengaktifkan' : 'menonaktifkan';

        $nasabah->banksampahs()->sync([
            $banksampah->id => [ 'status_id' => $status_id ]
        ]);

        return redirect()->back()->with('status', 'Berhasil ' . $msg . ' nasabah.');
    }

    public function pegawaiIndex()
    {
        $this->authorize('viewAny', Pegawai::class);

        return view('banksampah.pegawai-index', [
            'title' => 'Pegawai',
            'pegawais' => Pegawai::where('banksampah_id', banksampah()->id)->with('user')->get()
        ]);
    }

    public function pegawaiCreate()
    {
        $this->authorize('viewAny', Pegawai::class);

        return view('banksampah.pegawai-create', [
            'title' => 'Tambah Pegawai',
        ]);
    }

    public function driverIndex()
    {
        $this->authorize('viewAny', Driver::class);

        return view('banksampah.driver-index', [
            'title' => 'Driver',
            'drivers' => Driver::where('banksampah_id', banksampah()->id)->with('user')->get()
        ]);
    }

    public function bankAccounts()
    {
        $bankAccounts = BankAccount::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->with(['bank'])
            ->get();

        return view('banksampah.account-settings.bank-account', [
            'title' => 'Akun Bank',
            'bankaccounts' => $bankAccounts,
        ]);
    }

    public function bankAccountStore(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'number' => 'required|numeric',
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $bankAccount = banksampah()->bankAccount()->create($request->all());

        return back()->with('status', 'Berhasil menambah Akun Bank');
    }

    public function bankAccountUpdate(Request $request, $id)
    {
        $request->validate([
            'bank_id' => 'required',
            'number' => 'required|numeric',
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);

        $bankAccount = BankAccount::find($id)->update($request->all());

        return back()->with('status', 'Berhasil mengubah Akun Bank');
    }

    public function bankAccountDestroy($id)
    {
        $bankAccount = BankAccount::find($id);

        $bankAccount->delete();

        return back()->with('status', 'Berhasil menghapus Akun Bank');
    }
}
