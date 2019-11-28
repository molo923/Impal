<?php

namespace App\Http\Controllers;

use App\Alamat;
use App\Http\Requests\PegawaiRequest;
use App\Pegawai;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' => 'verified', 'banksampah']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny');

        return 'sadsadsa';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'status_id' => config('constants.statuses.AKTIF'),
            /*'activated_at' => now(),*/
        ]);

        $alamat = Alamat::create([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'districts' => $request->districts,
            'urban' => $request->urban,
        ]);

        $alamat->user()->save($user);

        $banksampah = Auth::user()->banksampah;

        $pegawai = Pegawai::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'type' => $request->type,
            'status_id' => config('constants.statuses.AKTIF'),
        ]);

        $pegawai->user()->associate($user);

        $pegawai->banksampah()->associate($banksampah);

        $pegawai->save();

        event(new Registered($pegawai->user));

        return redirect(route('banksampah.pegawai-index'))->with('status', 'Berhasil menambah pegawai.');
    }

    public function toggleStatus(Pegawai $pegawai)
    {
        $status = $pegawai->user->status_id == config('constants.statuses.AKTIF')
            ? config('constants.statuses.NONAKTIF')
            : config('constants.statuses.AKTIF');
        $message = $status == config('constants.statuses.AKTIF')
            ? 'menonaktifkan'
            : 'mengaktifkan';

        $pegawai->user->update([
            'status_id' => $status,
        ]);

        return redirect()->back()->with('status', 'Berhasil ' . $message . ' pegawai');
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $pegawai->update($request->all());

        return redirect()->back()->with('status', 'Berhasil menyunting pegawai');
    }
}
