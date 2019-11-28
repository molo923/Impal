<?php

namespace App\Repositories;

use App\Kategorisampah;
use App\Notifications\SetoranSelesai;
use App\Setoran;
use Carbon\Carbon;

class SetoranRepository implements SetoranRepositoryInterface
{
    private $setoran;

    public function setSetoran(Setoran $setoran)
    {
        $this->setoran = $setoran;
    }

    public function all()
    {
        return Setoran::whereHas('kategorisampahs', function ($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->with(['kategorisampahs' => function ($query) {
                $query->where('setoran_detail.status_id', '!=', config('constants.statuses.REJECT'));
            }, 'nasabah', 'status', 'setoranDetail'])
            ->whereNotNull('store_in')
            ->get();
    }

    public function show($setoran)
    {
        return [
            $setoran->load(['setoranDetail' => function ($query) {
                $query->with(['status', 'kategorisampah']);
            }])
        ];
    }

    public function store($data)
    {
        $banksampah = banksampah()->id;

        $this->setSetoran(new Setoran);

        $this->setoran->fill($data->except(['kategorisampahs', 'weight', 'custom_price', 'store_in', 'nasabah_id']));
        $this->setoran->store_in = $data->store_in
                                ? Carbon::createFromFormat('d/m/Y', $data->store_in)
                                : Carbon::now();
        $this->setoran->nasabah_id = $data->nasabah_id === 'bn' ? null : $data->nasabah_id;
        $this->setoran->banksampah()->associate($banksampah);

        $inputer = auth()->user()->banksampah ? null : auth()->user()->pegawai->id;

        if ($inputer) {
            $this->setoran->pegawai()->associate($inputer);
        }

        $this->setoran->save();

        $this->storeSetoranDetail(collect($data->weight), collect($data->kategorisampahs), $data);

        $this->setoran->save();

        $this->sendNotificationIfDone();

        return $this->setoran;
    }

    public function update($data)
    {
        $this->setoran->fill(collect($data)->only(['type', 'store_cost', 'description'])->toArray());
        $this->setoran->store_in = Carbon::createFromFormat('d/m/Y', $data['store_in']);
        $this->setoran->nasabah_id = $data['nasabah_id'] === 'bn' ? null : $data['nasabah_id'];
        $this->setoran->price_total = 0;
        $this->setoran->status_id = $data['status_id'] ?? config('constants.statuses.DIPROSES');

        $this->setInputer();

        $setoranDetail = $this->updateSetoranDetail($data);

        $this->setoran->kategorisampahs()->sync($setoranDetail);

        if ($this->isHomogenous($data['setoran_detail_status'], "9")) {
            $this->setStatusDone();
        }

        $this->setoran->touch();

        $this->sendNotificationIfDone();

        return $this->setoran;
    }

    public function done() {

        $this->setStatusDone();

        $this->setInputer();

        $this->setoran->kategorisampahs()->sync(
            $this->setoran->setoranDetail->mapWithKeys(function ($item) {
                return [$item['kategorisampah_id'] => $item->only(['status_id', 'weight', 'sub_total', 'custom_price'])];
            })->toArray()
        );

        $this->setoran->touch();

        $this->sendNotificationIfDone();

        return $this->setoran;
    }

    public function reject() {

        $this->setStatusReject();

        $this->setInputer();

        $this->setoran->kategorisampahs()->sync(
            $this->setoran->setoranDetail->mapWithKeys(function ($item) {
                return [$item['kategorisampah_id'] => $item->only(['status_id', 'weight', 'sub_total', 'custom_price'])];
            })->toArray()
        );

        $this->setoran->touch();

        return $this->setoran;
    }

    protected function setStatusDone(): void
    {
        $this->setoran->status_id = config('constants.statuses.SELESAI');
    }

    protected function setStatusReject(): void
    {
        $this->setoran->status_id = config('constants.statuses.REJECT');
    }

    protected function setInputer(): void
    {
        $inputer = auth()->user()->banksampah ? null : auth()->user()->pegawai->id;

        if ($inputer) {
            $this->setoran->pegawai()->associate($inputer);
        } else {
            $this->setoran->pegawai()->dissociate();
        }
    }

    protected function updateSetoranDetail($data)
    {
        $setoran = $this->setoran;

        return array_combine($data['kategorisampahs'], collect($data['weight'])
            ->map(function ($value, $index) use ($data, $setoran) {
                $kategorisampah = Kategorisampah::whereHas('banksampahs', function ($query) {
                    $query->where('banksampah_id', banksampah()->id);
                })->find($data['kategorisampahs'][$index]);

                /*$price = $setoran->type === 'beli' ? $data['custom_price'][$index] : $kategorisampah->banksampahKategorisampah->first()->price;*/
                $price = $setoran->type === 'beli'
                    ? $data['custom_price'][$index]
                    : ($setoran->setoranDetail->where('kategorisampah_id', $kategorisampah->id)->first()->store_price
                        ?? $kategorisampah->banksampahKategorisampah->first()->price);

                $setoran->price_total = $data['setoran_detail_status'][$index] == config('constants.statuses.REJECT')
                    ? $setoran->price_total
                    : $setoran->price_total + $price * $data['weight'][$index];

                if ($setoran->type === 'hibah' || $setoran->type === 'retur') {
                    $setoran->price_total = 0;
                }

                return [
                    'weight' => $value,
                    'status_id' => $data['setoran_detail_status'][$index],
                    /*'last_status_id' => $setoran->setoranDetail->where('kategorisampah_id', $kategorisampah->id)
                        ->first()->status_id,*/
                    'sub_total' => $price * $data['weight'][$index],
                    'custom_price' => $setoran->type === 'beli' ? $data['custom_price'][$index] : null,
                ];
            })
            ->toArray());
    }

    protected function storeSetoranDetail($weight, $kategorisampahs, $data)
    {
        $setoran = $this->setoran;

        return $setoran->kategorisampahs()->attach(
            $weight->mapWithKeys(function ($item, $index) use ($kategorisampahs, $setoran, $data) {
                $price = $setoran->type === 'beli'
                    ? $data->custom_price[$index]
                    : Kategorisampah::whereHas('banksampahs', function ($query) {
                        $query->where('banksampah_id', banksampah()->id);
                    })->find($kategorisampahs[$index])->banksampahKategorisampah->first()->price;

                $setoran->price_total += $price * $item;

                if ($setoran->type === 'hibah' || $setoran->type === 'retur') {
                    $setoran->price_total = 0;
                }

                return [$kategorisampahs[$index] => [
                    'weight' => $item,
                    'status_id' => (int) $data->status_id
                    === config('constants.statuses.DIPROSES')
                        ? config('constants.statuses.BELUMSELESAI')
                        : $data->status_id,
                    'sub_total' => $price * $item,
                    'custom_price' => $setoran->type === 'beli' ? $data->custom_price[$index] : null,
                ]];
            })->toArray()
        );
    }

    protected function sendNotificationIfDone()
    {
        if ((int) $this->setoran->status_id === config('constants.statuses.SELESAI')
            && $this->setoran->nasabah_id !== null) {
            banksampah()->notify(new SetoranSelesai($this->setoran));
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

    public function destroy($setoran)
    {
        //
    }
}
