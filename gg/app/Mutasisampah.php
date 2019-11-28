<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mutasisampah extends Model
{

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            $stokTransfer = Stok::find($item->kategorisampahTransfer->kategorisampah->stok->first()->id);
            $stokTerima = Stok::find($item->kategorisampahTerima->kategorisampah->stok->first()->id);

            $stokTransfer->quantity_mutasi_transfer += (double) $item->weight;
            $stokTerima->quantity_mutasi_terima += (double) $item->weight;

            $stokTransfer->save();
            $stokTerima->save();
        });
    }

    public function getWeightPrettyAttribute()
    {
        return number_format($this->weight, 2, ',', '.');
    }

    public function getDateMutasiPrettyAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date_mutasi)->isoFormat('dddd, DD MMM YYYY');
    }

    public function kategorisampahTransfer()
    {
        return $this->belongsTo('App\BanksampahKategorisampah', 'kategorisampah_transfer_id');
    }

    public function kategorisampahTerima()
    {
        return $this->belongsTo('App\BanksampahKategorisampah', 'kategorisampah_terima_id');
    }
}
