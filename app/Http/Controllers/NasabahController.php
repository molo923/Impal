<?php

namespace App\Http\Controllers;

use App\Alamat;
use App\Http\Requests\NasabahRequest;
use App\Nasabah;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasabahController extends Controller
{
    public function __construct() {
        $this->middleware(['auth' => 'verified', 'nasabah'])->except('store');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(NasabahRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'status_id' => config('constants.statuses.NONAKTIF'),
        ]);

        $alamat = Alamat::create([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'districts' => $request->districts,
            'urban' => $request->urban,
        ]);

        $alamat->user()->save($user);

        $user->nasabah()->create($request->only(['name', 'gender']));

        return redirect()->back();
    }

    public function show(Nasabah $nasabah)
    {
        //
    }

    public function edit(Nasabah $nasabah)
    {
        //
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        //
    }

    public function destroy(Nasabah $nasabah)
    {
        //
    }
}
