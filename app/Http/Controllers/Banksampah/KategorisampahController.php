<?php

namespace App\Http\Controllers\Banksampah;

use App\Banksampah;
use App\BanksampahKategorisampah;
use App\Http\Requests\KategorisampahRequest;
use App\Kategorisampah;
use App\Mutasisampah;
use App\Residusampah;
use App\Stok;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class KategorisampahController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Kategorisampah::class);

        $kategorisampahs = Kategorisampah::with('banksampahKategorisampah')->get();

        return view('banksampah.kategori-sampah.index', [
            'title' => 'Kategori Sampah',
            'kategorisampahs' => $kategorisampahs,
        ]);
    }

    public function show(Kategorisampah $kategorisampah)
    {
        if (request()->ajax()) {
            return $kategorisampah;
        }
    }

    public function indexStok()
    {
        $this->authorize('viewAny', Kategorisampah::class);

        $stokKategorisampah = Stok::whereHas('banksampah', function($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->with(['kategorisampah', 'banksampah'])
            ->get();

        return view('banksampah.kategori-sampah.index-stok', [
            'title' => 'Stok',
            'stoks' => $stokKategorisampah,
        ]);
    }

    public function showStok(Stok $stok)
    {
        $this->authorize('viewAny', Kategorisampah::class);

        $yearStart = $this->startDateValid() ? $this->parseStartDate()[2] : null;
        $monthStart = $this->startDateValid() ? $this->parseStartDate()[1] : null;
        $dayStart = $this->startDateValid() ? $this->parseStartDate()[0] : null;

        $yearEnd = $this->endDateValid() ? $this->parseEndDate()[2] : null;
        $monthEnd = $this->endDateValid() ? $this->parseEndDate()[1] : null;
        $dayEnd = $this->endDateValid() ? $this->parseEndDate()[0] : null;

        $dateStart = Carbon::createFromDate($yearStart, $monthStart, $dayStart)
            ->setTime(0, 0, 0);
        $dateEnd = Carbon::createFromDate($yearEnd, $monthEnd, $dayEnd)
            ->setTime('23', '59', '59', '999999');

        /*dd($stok->kategorisampah->first()->id);*/

        $setorandetail = Kategorisampah::whereHas('banksampahKategorisampah')->with([
                'banksampahKategorisampah' => function ($query) use ($stok, $dateStart, $dateEnd) {
                    $query->with(['mutasiTransfer' => function ($query) use ($stok, $dateStart, $dateEnd) {

                        $query->where('kategorisampah_transfer_id', $stok->id);

                        $this->whereBetween($query, 'date_mutasi', [$dateStart, $dateEnd]);
                    }, 'mutasiTerima' => function ($query) use ($stok, $dateStart, $dateEnd) {

                        $query->where('kategorisampah_terima_id', $stok->id);

                        $this->whereBetween($query, 'date_mutasi', [$dateStart, $dateEnd]);
                    }, 'residu' => function ($query) use ($stok, $dateStart, $dateEnd) {

                        $query->where('banksampah_kategorisampah_id', $stok->id);

                        $this->whereBetween($query, 'date_residu', [$dateStart, $dateEnd]);
                    }]);
                },
                'setorans' => function ($query) use ($stok, $dateStart, $dateEnd) {

                    $query->with(['setoranDetail' => function ($query) use ($stok, $dateStart, $dateEnd) {
                            $query->where('kategorisampah_id', $stok->kategorisampah->first()->id);
                        }])
                        ->where('setorans.status_id', '!=', config('constants.statuses.DIPROSES'));

                    $this->whereBetween($query, 'store_done', [$dateStart, $dateEnd]);
                },
                'sampahkeluars' => function ($query) use ($stok, $dateStart, $dateEnd) {

                    $query->with(['sampahkeluarDetail' => function ($query) use ($stok) {
                            $query->where('kategorisampah_id', $stok->kategorisampah->first()->id);
                        }])
                        ->where('sampahkeluars.status_id', '!=', config('constants.statuses.DIPROSES'));

                    $this->whereBetween($query,'date_done', [$dateStart, $dateEnd]);
                },
            ])
            ->where('id', $stok->kategorisampah->first()->id)
            ->get();

        $setorans = $setorandetail->first()->setorans ?? [];
        $sampahkeluars = $setorandetail->first()->sampahkeluars ?? [];
        $transfer = $setorandetail->first()->banksampahKategorisampah->first()->mutasiTransfer ?? [];
        $terima = $setorandetail->first()->banksampahKategorisampah->first()->mutasiTerima ?? [];
        $residu = $setorandetail->first()->banksampahKategorisampah->first()->residu ?? [];

        $all = new Collection;
        $all = $all->concat($setorans);
        $all = $all->concat($sampahkeluars);
        $all = $all->concat($transfer);
        $all = $all->concat($terima);
        $all = $all->concat($residu);

        $filterText = 'Semua';

        if (request()->has('tab')) {
            $filterText = $dateStart->isoFormat('MMMM YYYY');
        }

        if (!request()->has('tab') && request()->has('start')) {
            $filterText = $dateStart->isoFormat('dddd, DD MMMM YYYY');
        }

        return view('banksampah.kategori-sampah.detail-stok', [
            'title' => $stok->kategorisampah->first()->code . ' - ' . $stok->kategorisampah->first()->name,
            'stoks' => $all->sortByDesc(function ($item) {
                return $item->store_done ?? $item->date_done ?? $item->date_mutasi ?? $item->date_residu;
            }),
            'kategorisampah_id' => $stok->id,
            'filterText' => $filterText,
        ]);
    }

    public function historyStok()
    {
        $yearStart = $this->startDateValid() ? $this->parseStartDate()[2] : null;
        $monthStart = $this->startDateValid() ? $this->parseStartDate()[1] : null;
        $dayStart = $this->startDateValid() ? $this->parseStartDate()[0] : null;

        $yearEnd = $this->endDateValid() ? $this->parseEndDate()[2] : null;
        $monthEnd = $this->endDateValid() ? $this->parseEndDate()[1] : null;
        $dayEnd = $this->endDateValid() ? $this->parseEndDate()[0] : null;

        $dateStart = Carbon::createFromDate($yearStart, $monthStart, $dayStart);
        $dateEnd = Carbon::createFromDate($yearEnd, $monthEnd, $dayEnd);

        $dateStart = $dateStart->startOfMonth();
        $dateEnd = $dateEnd->endOfMonth();

        $dateStart->toDateTimeString();
        $dateEnd->toDateTimeString();

        $stoks = Kategorisampah::whereHas('banksampahKategorisampah', function ($query) {

            $query->where('banksampah_id', banksampah()->id);
        })->with(['setorans' => function ($query) use ($dateStart, $dateEnd) {

            $query->whereBetween('store_in', [$dateStart, $dateEnd])
                ->with('setoranDetail');
        }, 'sampahkeluars' => function ($query) use ($dateStart, $dateEnd) {

            $query->whereBetween('date_in', [$dateStart, $dateEnd])
                ->where('banksampah_id', banksampah()->id)
                ->with('sampahkeluarDetail');
        }, 'transfer' => function ($query) use ($dateStart, $dateEnd) {

            $query->whereBetween('date_mutasi', [$dateStart, $dateEnd]);
        }, 'terima' => function ($query) use ($dateStart, $dateEnd) {

            $query->whereBetween('date_mutasi', [$dateStart, $dateEnd]);
        }, 'residu' => function ($query) use ($dateStart, $dateEnd) {

            $query->whereHas('kategorisampah', function ($query) {
                    $query->where('banksampah_id', banksampah()->id);
                })
                ->whereBetween('date_residu', [$dateStart, $dateEnd]);
        }])->get();

        $now = true;

        if(request()->has('start') && $monthStart != now()->format('m')) {
            $now = false;
        }

        return view('banksampah.kategori-sampah.histori-stok', [
            'title' => 'Stok Sampah',
            'stoks' => $stoks,
            'now' => $now,
        ]);
    }

    public function showMutasi(Kategorisampah $kategorisampah)
    {
        $this->authorize('viewAny', Kategorisampah::class);

        $transfer = Mutasisampah::whereHas('kategorisampahTransfer', function ($query) use ($kategorisampah) {
                $query->where('banksampah_id', banksampah()->id)
                    ->where('kategorisampah_id', $kategorisampah->id);
            })
            ->with(['kategorisampahTransfer' => function ($query) use ($kategorisampah) {
                $query->where('banksampah_id', banksampah()->id)
                    ->where('kategorisampah_id', $kategorisampah->id)
                    ->with('kategorisampah');
            }])
            ->get();

        $terima = Mutasisampah::whereHas('kategorisampahTerima', function ($query) use ($kategorisampah) {
                $query->where('banksampah_id', banksampah()->id)
                    ->where('kategorisampah_id', $kategorisampah->id);
            })
            ->with(['kategorisampahTerima' => function ($query) use ($kategorisampah) {
                $query->where('banksampah_id', banksampah()->id)
                    ->where('kategorisampah_id', $kategorisampah->id)
                    ->with('kategorisampah');
            }])
            ->get();

        return view('banksampah.kategori-sampah.detail-mutasi', [
            'title' => $kategorisampah->code . ' - ' . $kategorisampah->name,
            'transfers' => $transfer,
            'terimas' => $terima,
            'kategorisampah_id' => $kategorisampah->id,
        ]);
    }

    public function storeMutasi(Request $request, Kategorisampah $kategorisampah)
    {
        $this->authorize('viewAny', Kategorisampah::class);

        $request->validate([
            'date_mutasi' => 'required',
            'kategorisampah_terima_id' => 'required',
            'weight' => 'required|numeric|not_in:0',
        ], [
            'weight.required' => 'Masukkan berat.',
            'weight.not_in' => 'Masukkan berat.',
        ], [
            'kategorisampah_terima_id' => 'Kategori sampah terima',
            'weight' => 'Berat',
        ]);

        $kategorisampah_ter = Kategorisampah::find($request->kategorisampah_terima_id);
        $kategorisampah_terima = $kategorisampah_ter->banksampahKategorisampah->first()->id;

        $mutasisampah = new Mutasisampah;
        $mutasisampah->fill([
            'date_mutasi' => now(),
            'weight' => $request->weight,
        ]);

        $total_kategorisampah_transfer = $kategorisampah->banksampahKategorisampah->first()->price * $request->weight;
        $total_kategorisampah_terima = $kategorisampah_ter->total_weight_minus * $kategorisampah_ter->banksampahKategorisampah->first()->price;

        $price_rec = ($total_kategorisampah_transfer + $total_kategorisampah_terima) / ($request->weight + $kategorisampah_ter->total_weight_minus);

        $kategorisampah->banksampahKategorisampah()->first()->update([
            'price_rec' => $price_rec,
        ]);

        $mutasisampah->kategorisampahTransfer()
            ->associate($kategorisampah->banksampahKategorisampah->first()->id);
        $mutasisampah->kategorisampahTerima()
            ->associate($kategorisampah_terima);

        $mutasisampah->save();

        return redirect()->back();
    }

    public function storeResidu(Request $request, Kategorisampah $kategorisampah)
    {
        $this->authorize('viewAny', Kategorisampah::class);

        $request->validate([
            'weight' => 'required|numeric|not_in:0',
        ], [
            'weight.required' => 'Masukkan berat.',
            'weight.not_in' => 'Masukkan berat.',
        ], [
            'weight' => 'Berat',
        ]);

        $residusampah = new Residusampah;
        $residusampah->fill([
            'date_residu' => now(),
            'weight' => $request->weight,
        ]);

        $residusampah->kategorisampah()
            ->associate($kategorisampah->banksampahKategorisampah->first()->id);

        $residusampah->save();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategorisampahRequest $request)
    {
        $this->authorize('create', Kategorisampah::class);

        // Create Kategori sampah for the first time and attach the current user banksampah id.
        $kategorisampah = Kategorisampah::create($request->all());
        $kategorisampah->banksampahs()->attach(banksampah());

        // Create Stok from Kategori sampah for the first time with default value
        // and attach the last inserted kategori sampah.
        $kategorisampah->stok()->create();

        return redirect(route('kategori-sampah.index'));
    }

    public function edit(Kategorisampah $kategoriSampah)
    {
        return view('banksampah.kategori-sampah.edit', [
            'title' => 'Edit Kategori Sampah - '.$kategoriSampah->code,
            'kategorisampah' => $kategoriSampah,
        ]);
    }

    public function update(KategorisampahRequest $request, Kategorisampah $kategoriSampah)
    {
        $this->authorize('update', $kategoriSampah);

        $kategoriSampah->update($request->all());

        return redirect(route('kategori-sampah.index'));
    }

    /*public function toggleStatus(Kategorisampah $kategorisampah)
    {
        $this->authorize('update', $kategorisampah);

        $kategorisampah->status_id = $kategorisampah->status_id === config('constants.statuses.NONAKTIF')
            ? config('constants.statuses.AKTIF')
            : config('constants.statuses.NONAKTIF');

        $kategorisampah->save();

        return redirect(route('kategori-sampah.index'));
    }*/

    public function changePrice(Request $request, $id)
    {
        $kategorisampah = Kategorisampah::find($id);

        $kategorisampah->banksampahs()->sync([
            banksampah()->id => [
                'price' => $request->price,
            ]
        ]);

        return redirect(route('kategori-sampah.index'))->with('status', 'Berhasil mengubah harga kategori.');
    }

    public function attachBanksampah(Request $request, $id)
    {
        $kategorisampah = Kategorisampah::find($id);

        $this->authorize('update', $kategorisampah);

        if ($kategorisampah->banksampahs->isEmpty()) {

            $request->validate([
                'price' => 'required',
            ]);

            $kategorisampah->banksampahs()->attach(banksampah()->id, [
                'price' => $request->price,
                'status_id' => config('constants.statuses.AKTIF'),
            ]);

            $kategorisampah->save();

            $pivot_id = $kategorisampah->load('banksampahs')->banksampahs->first()->pivot->id;

            Stok::create([
                'banksampah_kategorisampah_id' => $pivot_id,
            ]);
        } else {

            $attrs = [
                'status_id' => config('constants.statuses.AKTIF'),
            ];

            if ($request->price) {
                $attrs['price'] = $request->price;
            }

            $kategorisampah->banksampahs()->updateExistingPivot(banksampah()->id, $attrs);

            $kategorisampah->save();
        }

        return redirect(route('kategori-sampah.index'))->with('status', 'Berhasil mengaktifkan kategori.');
    }

    public function deactivateKategorisampah(Request $request)
    {
        $kategorisampah = Kategorisampah::find($request->id);

        $this->authorize('update', $kategorisampah);

        $kategorisampah->banksampahs()->updateExistingPivot(banksampah()->id,
            ['status_id' => config('constants.statuses.NONAKTIF')]
        );

        return redirect(route('kategori-sampah.index'))->with('status', 'Berhasil menonaktifkan kategori.');
    }

    private function whereBetween($query, $key, $date) {
        if (request()->has('start') && request()->has('end')) {
            return $query->whereBetween($key, $date);
        }
        return false;
    }

    public function startDateValid()
    {
        return request()->start && strlen(request()->start) === 10;
    }

    public function parseStartDate()
    {
        return explode('-', request()->start);
    }

    public function endDateValid()
    {
        return request()->end && strlen(request()->end) === 10;
    }

    public function parseEndDate()
    {
        return explode('-', request()->end);
    }
}
