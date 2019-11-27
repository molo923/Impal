<?php


namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SetoranDetail extends Pivot
{
    protected $table = 'setoran_detail';

    protected $guarded = [];

    protected $hidden = [
        'id'
    ];

    protected $appends = [
        'sub_total_rp',
        'store_price_rp'
    ];

    public function getStatusIdAttribute($value)
    {
        return $value;
    }

    public function getSubTotalRpAttribute()
    {
        return number_format($this->sub_total, 0, ',', '.');
    }

    public function getStorePriceRpAttribute()
    {
        return number_format(round($this->sub_total/$this->weight), 0, ',', '.');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function kategorisampah()
    {
        return $this->belongsTo('App\Kategorisampah');
    }

    public function setoran()
    {
        return $this->belongsTo('App\Setoran');
    }
}
