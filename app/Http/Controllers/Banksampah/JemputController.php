<?php

namespace App\Http\Controllers\Banksampah;

use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Jemput;
use App\Nasabah;
use App\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JemputController extends Controller
{
    public function index()
    {
        /*$this->authorize('viewAny', Jemput::class);*/

        $jemput = Jemput::whereHas('jadwal', function ($query) {
                $query->where('banksampah_id', request()->get('banksampah_id') ?? banksampah()->id);
            })->with(['setoran' => function ($query) {
                    $query->with(['nasabah' => function ($query) {
                        $query->with(['user']);
                    }]);
                }, 'pegawai', 'status'])
            ->get();

        if (request()->ajax()) {
            return $jemput;
        }

        $jadwal = Jadwal::where('banksampah_id', request()->get('banksampah_id') ?? banksampah()->id)
            ->whereHas('nasabah', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->whereNotNull('alamat_id');
                });
            })
            ->whereNotNull('weeks')
            ->whereNotNull('days')
            ->with(['banksampah', 'nasabah' => function ($query) {
                $query->with(['user' => function ($query) {
                    $query->with('alamat');
                }]);
            }])
            ->get();

        $nasabah = Nasabah::whereHas('banksampahs', function ($query) {
                $query->where('banksampah_id', request()->get('banksampah_id') ?? banksampah()->id)
                    ->whereNull('weeks')
                    ->whereNull('days');
            })->get();

        $drivers = Pegawai::whereHas('banksampah', function ($query) {
                $query->where('banksampah_id', request()->get('banksampah_id') ?? banksampah()->id);
            })
            ->where('type', 'driver')
            ->get();

        return view('banksampah.jemput.index', [
            'title' => 'Setoran Jemput',
            'jadwals' => $jadwal,
            'jemputs' => $jemput,
            'nasabahs' => $nasabah,
            'drivers' => $drivers,
            'weeks' => $jadwal->map(function ($item, $key) {
                $weeks = explode(';', $item->weeks);
                return $weeks;
            }),
        ]);
    }

    public function show(Jemput $jemput)
    {
        if (request()->ajax()) {
            return Jemput::where('id', $jemput->id)->with(['jadwal' => function ($query) {
                $query->with(['nasabah' => function ($query) {
                    $query->with(['user']);
                }]);
            }])->get();
        }
    }

    public function edit(Jemput $jemput)
    {
        //
    }

    public function update(Request $request, Jemput $jemput)
    {
        if ($request->has('date_pick_up')) {
            $request->date_pick_up = Carbon::createFromFormat('d/m/Y', $request->date_pick_up)->format('Y-m-d H:i:s');
        }

        $jemput->update($request->except('_token'));

        return redirect()->back()->with('status', 'Berhasil menyunting permintaan jemput ' . $jemput->setoran->nasabah->name);

    }

    public function reject(Jemput $jemput)
    {
        $jemput->status_id = config('constants.statuses.DITOLAK');

        $jemput->save();

        return redirect()->back()->with('status', 'Berhasil menolak permintaan ' . $jemput->setoran->nasabah->name);
    }

    public function confirm(Request $request, Jemput $jemput)
    {
        $jemput->status_id = config('constants.statuses.BELUMJEMPUT');
        $jemput->update([
            'pegawai_id' => $request->pegawai_id
        ]);

        $jemput->save();

        return redirect()->back()->with('status', 'Berhasil mengonfirmasi setoran ' . $jemput->setoran->nasabah->name);
    }

    public function pickUp(Jemput $jemput)
    {
        $jemput->status_id = config('constants.statuses.DIJEMPUT');

        $jemput->save();

        return redirect()->back()->with('status', 'Berhasil menjemput setoran ' . $jemput->setoran->nasabah->name);
    }

    public function done(Jemput $jemput)
    {
        $jemput->status_id = config('constants.statuses.SELESAI');
        $jemput->setoran()->update([
            'store_in' => now(),
        ]);

        $jemput->save();

        return redirect()->back()->with('status', 'Berhasil menyelesaikan setoran ' . $jemput->setoran->nasabah->name);
    }
}
