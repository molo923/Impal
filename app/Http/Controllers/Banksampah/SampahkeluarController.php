<?php

namespace App\Http\Controllers\Banksampah;

use App\Http\Controllers\Controller;
use App\Http\Requests\SampahkeluarRequest;
use App\Kategorisampah;
use App\Sampahkeluar;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class SampahkeluarController extends Controller
{
    public function index()
    {
        $sampahkeluars = Sampahkeluar::whereHas('kategorisampahs', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->with(['kategorisampahs' => function ($query) {
                $query->where('sampahkeluar_details.status_id', '!=', config('constants.statuses.REJECT'));
            }, 'status'])
            ->get();

        return view('banksampah.sampah-keluar.index', [
            'title' => 'Sampah Keluar',
            'sampahkeluars' => $sampahkeluars,
        ]);
    }

    public function create()
    {
        return view('banksampah.sampah-keluar.create', [
            'title' => 'Tambah Sampah Keluar',
        ]);
    }

    public function store(SampahkeluarRequest $request)
    {
        $banksampah = banksampah()->id;

        $inputer = auth()->user()->banksampah ? null : auth()->user()->pegawai->id;

        $sampahkeluar = new Sampahkeluar;
        $sampahkeluar->fill($request->except(['_token', 'kategorisampahs', 'weight', 'price']));
        $sampahkeluar->date_in = $request->date_in
            ? Carbon::createFromFormat('d/m/Y', $request->date_in)
            : Carbon::now();
        $sampahkeluar->banksampah()->associate($banksampah);

        if($inputer) {
            $sampahkeluar->pegawai()->associate($inputer);
        }

        $sampahkeluar->save();

        $kategorisampahs = collect($request->kategorisampahs);
        $weight = collect($request->weight);

        $sampahkeluar->kategorisampahs()->attach(
            $weight->mapWithKeys(function ($item, $index) use ($kategorisampahs, $sampahkeluar, $request) {

                $sampahkeluar->price_total += $request->price[$index] * $item;

                return [$kategorisampahs[$index] => [
                    'weight' => $item,
                    'price' => $request->price[$index],
                    'status_id' => (int) $request->status_id
                                    === config("constants.statuses.DIPROSES")
                                        ? config("constants.statuses.BELUMSELESAI")
                                        : $request->status_id,
                    'sub_total' => $request->price[$index] * $item,
                ]];
            })->toArray()
        );

        $sampahkeluar->save();

        return redirect(route('sampah-keluar.index'))->with('status', 'Sampah keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $sampahKeluar = Sampahkeluar::find($id);

            return [
                $sampahKeluar->load(['sampahkeluarDetail' => function ($query) {
                    $query->with(['status', 'kategorisampah']);
                }]),
            ];
        }

        $sampahKeluar = Sampahkeluar::find($this->handleDecryptException($id));

        return view('banksampah.sampah-keluar.show', [
            'title' => 'Detail Sampah Keluar',
            'sampahkeluar' => $sampahKeluar->load(['sampahkeluarDetail' => function ($query) {
                $query->with(['status', 'kategorisampah']);
            }]),
        ]);
    }

    public function edit($id)
    {
        $sampahkeluar = Sampahkeluar::find($this->handleDecryptException($id));
        $this->authorize('update', $sampahkeluar);

        return view('banksampah.sampah-keluar.edit', [
            'title' => 'Edit Sampah Keluar '.$sampahkeluar->id_pretty,
            'sampahkeluar' => $sampahkeluar,
        ]);
    }

    public function done($id)
    {
        $sampahkeluar = Sampahkeluar::find($this->handleDecryptException($id));
        $this->authorize('update', $sampahkeluar);

        $inputer = auth()->user()->banksampah ? null : auth()->user()->pegawai->id;

        if ($inputer) {
            $sampahkeluar->pegawai()->associate($inputer);
        } else if ($sampahkeluar->pegawai) {
            $sampahkeluar->pegawai()->dissociate();
        }

        $sampahkeluar->status_id = config('constants.statuses.SELESAI');

        $sampahkeluar->kategorisampahs()->sync(
            $sampahkeluar->sampahkeluarDetail->mapWithKeys(function ($item) {
                return [$item['kategorisampah_id'] => $item->only(['status_id', 'weight', 'sub_total', 'price'])];
            })->toArray()
        );

        $sampahkeluar->touch();

        return redirect(route('sampah-keluar.index'))->with('status', 'Sampah keluar berhasil diselesaikan');
    }

    public function reject($id)
    {
        $sampahkeluar = Sampahkeluar::find($this->handleDecryptException($id));
        $this->authorize('update', $sampahkeluar);

        $inputer = auth()->user()->banksampah ? null : auth()->user()->pegawai->id;

        if ($inputer) {
            $sampahkeluar->pegawai()->associate($inputer);
        } else if ($sampahkeluar->pegawai) {
            $sampahkeluar->pegawai()->dissociate();
        }

        $sampahkeluar->status_id = config('constants.statuses.REJECT');

        $sampahkeluar->kategorisampahs()->sync(
            $sampahkeluar->sampahkeluarDetail->mapWithKeys(function ($item) {
                return [$item['kategorisampah_id'] => $item->only(['status_id', 'weight', 'sub_total', 'price'])];
            })->toArray()
        );

        $sampahkeluar->touch();

        return redirect(route('sampah-keluar.index'))->with('status', 'Sampah keluar berhasil direject');
    }

    public function update(SampahkeluarRequest $request, Sampahkeluar $sampahKeluar)
    {
        $sampahKeluar->fill($request->except(['_token', 'kategorisampahs', 'weight', 'price', 'sampahkeluar_detail_status', 'status_id']));
        $sampahKeluar->date_in = Carbon::createFromFormat('d/m/Y', $request->date_in);
        $sampahKeluar->price_total = 0;
        $sampahKeluar->status_id = $request->status_id ?? config('constants.statuses.DIPROSES');

        $inputer = auth()->user()->banksampah ? null : auth()->user()->pegawai->id;

        if ($inputer) {
            $sampahKeluar->pegawai()->associate($inputer);
        } else if ($sampahKeluar->pegawai) {
            $sampahKeluar->pegawai()->dissociate();
        }

        $sampahKeluar->kategorisampahs()->sync(
            collect($request->weight)->mapWithKeys(function ($item, $index) use ($sampahKeluar, $request) {

                $sampahKeluar->price_total = $request->sampahkeluar_detail_status[$index] == config('constants.statuses.REJECT')
                    ? $sampahKeluar->price_total
                    : $sampahKeluar->price_total + $request->price[$index] * $item;

                return [$request->kategorisampahs[$index] => [
                    'weight' => $item,
                    'price' => $request->price[$index],
                    'status_id' => $request->sampahkeluar_detail_status[$index],
                    'sub_total' => $request->price[$index] * $item,
                ]];
            })->toArray()
        );

        if ($this->isHomogenous($request->sampahkeluar_detail_status, "9")) {
            $sampahKeluar->status_id = config('constants.statuses.SELESAI');
        }

        $sampahKeluar->touch();

        return redirect(route('sampah-keluar.index'))->with('status', 'Sampah keluar berhasil diubah.');
    }

    private function handleDecryptException($id) {
        try {
                $decrypted = Crypt::decrypt($id);
                return $decrypted;
            } catch (DecryptException $e) {
                return abort(404);
            }
    }

    function isHomogenous(array $arr, $testValue = null) {
        // If they did not pass the 2nd func argument, then we will use an arbitrary value in the $arr.
        // By using func_num_args() to test for this, we can properly support testing for an array filled with nulls, if desired.
        // ie isHomogenous([null, null], null) === true
        $testValue = func_num_args() > 1 ? $testValue : current($arr);
        foreach ($arr as $val) {
            if ($testValue !== $val) {
                return false;
            }
        }
        return true;
    }

    public function destroy(Sampahkeluar $sampahkeluar)
    {
        //
    }
}
