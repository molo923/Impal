<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Residusampah extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            $residu = Stok::find($item->kategorisampah->kategorisampah->stok->first()->id);

            $residu->quantity_residu += (double) $item->weight;

            $residu->save();
        });
    }

    public function getWeightPrettyAttribute()
    {
        return number_format($this->weight, 2, ',', '.');
    }

    public function getDateResiduPrettyAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date_residu)->isoFormat('dddd, DD MMM YYYY');
    }

    public function kategorisampah()
    {
        return $this->belongsTo('App\BanksampahKategorisampah', 'banksampah_kategorisampah_id');
    }
}
