<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BanksampahKategorisampah extends Pivot
{
    protected $table = 'banksampah_kategorisampah';

    protected $guarded = [];

    public function mutasiTransfer()
    {
        return $this->hasMany('App\Mutasisampah', 'kategorisampah_transfer_id');
    }

    public function mutasiTerima()
    {
        return $this->hasMany('App\Mutasisampah', 'kategorisampah_terima_id');
    }

    public function residu()
    {
        return $this->hasMany('App\Residusampah', 'banksampah_kategorisampah_id');
    }

    public function kategorisampah()
    {
        return $this->belongsTo('App\Kategorisampah');
    }

    public function banksampah()
    {
        return $this->belongsTo('App\Banksampah');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
