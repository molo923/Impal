<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SampahkeluarDetail extends Pivot
{
    protected $table = 'sampahkeluar_details';

    protected $guarded = [];

    protected $hidden = [
        'id'
    ];

    protected $appends = [
        'sub_total_rp',
        'price_rp'
    ];

    public function getSubTotalRpAttribute()
    {
        return number_format($this->sub_total, 0, ',', '.');
    }

    public function getPriceRpAttribute()
    {
        return number_format($this->price, 0, ',', '.');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function kategorisampah()
    {
        return $this->belongsTo('App\Kategorisampah');
    }

    public function sampahkeluar()
    {
        return $this->belongsTo('App\Sampahkeluar');
    }
}
