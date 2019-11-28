<?php

namespace App\Http\Controllers\Banksampah;

use App\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    public function index()
    {
        /*$this->authorize('viewAny', Jadwal::class);*/

        $jadwal = Jadwal::where('banksampah_id', request()->get('banksampah_id') ?? banksampah()->id)
            ->whereHas('nasabah', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->whereNotNull('alamat_id');
                });
            })
            ->with(['banksampah', 'nasabah' => function ($query) {
                $query->with(['user' => function ($query) {
                    $query->with('alamat');
                }]);
            }])
            ->where('status_id', '!=', config('constants.statuses.NONAKTIF'))
            ->whereNotNull('weeks')
            ->whereNotNull('days')
            ->get();

        if (request()->ajax()) {
            return $jadwal;
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nasabah_id' => 'required',
            'weeks' => 'required',
            'days' => 'required',
            'status_id' => 'required',
        ]);

        $jadwal = Jadwal::where('nasabah_id', $request->nasabah_id)->firstOrFail();

        $jadwal->update([
            'weeks' => implode(';', $request->weeks),
            'days' => collect($request->weeks)->map(function ($item, $index) use ($request) {
                    return implode(",", $request->days[$index]);
                })->implode(";"),
            'status_id' => $request->status_id,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('status', 'Berhasil menambah jadwal');
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        if ($request->has('weeks')) {
            $jadwal->weeks = implode(';', $request->weeks);
        }

        if ($request->has('days')) {
            $jadwal->days = collect($request->weeks)->map(function ($item, $index) use ($request) {
                return implode(",", $request->days[$index]);
            })->implode(";");
        }

        $jadwal->save();

        return redirect()->back()->with('status', 'Berhasil mengubah jadwal ' . $jadwal->nasabah->name);
    }

    public function acceptJadwal(Jadwal $jadwal)
    {
        $jadwal->status_id = config('constants.statuses.AKTIF');

        $jadwal->save();

        return redirect()->back()->with('status', 'Berhasil menerima jadwal ' . $jadwal->nasabah->name);
    }

    public function rejectJadwal(Jadwal $jadwal)
    {
        $jadwal->update([
            'weeks' => null,
            'days' => null,
        ]);

        return redirect()->back()->with('status', 'Berhasil menolak jadwal ' . $jadwal->nasabah->name);
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->update([
            'weeks' => null,
            'days' => null,
        ]);

        return redirect()->back()->with('status', 'Berhasil menghapus jadwal ' . $jadwal->nasabah->name);
    }
}
