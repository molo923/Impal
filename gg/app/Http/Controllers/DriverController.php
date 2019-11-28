<?php

namespace App\Http\Controllers;

use App\Jemput;
use App\User;
use App\Driver;
use App\Http\Requests\DriverRequest;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function index()
    {
        $jemputs = Jemput::whereHas('jadwal', function ($query) {
                $query->where('banksampah_id', request()->get('banksampah_id') ?? banksampah()->id);
            })
            ->where('pegawai_id', auth()->user()->pegawai->id)
            ->with(['setoran' => function ($query) {
                $query->with(['nasabah' => function ($query) {
                    $query->with(['user']);
                }]);
            }, 'pegawai', 'status'])
            ->get();

        return view('banksampah.driver.index', compact('jemputs'));
    }

    public function create()
    {
        //
    }

    public function store(DriverRequest $request)
    {
        $user = new User;
        $user->fill($request->except(['name', 'password']));
        $user->password = Hash::make($request->password);
        $user->save();

        $banksampah = auth()->user()->banksampah;

        $driver = Driver::create([
            'name' => $request->name,
        ]);

        $driver->user()->associate($user);

        $driver->banksampah()->associate($banksampah);

        $driver->save();

        return redirect()->back();
    }

    public function show(Driver $driver)
    {
        //
    }

    public function edit(Driver $driver)
    {
        //
    }

    public function update(DriverRequest $request, Driver $driver)
    {
        //
    }

    public function destroy(Driver $driver)
    {
        //
    }
}
