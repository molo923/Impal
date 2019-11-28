<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $guarded = [];

//    protected $with = ['banksampah', 'nasabah'];

    public function getWeeksArrayAttribute()
    {
        return explode(';', $this->weeks);
    }

    public function getDaysArrayAttribute()
    {
        return collect(explode(';', $this->days))->map(function ($item) {
            return explode(',', $item);
        });
    }

    public function banksampah()
    {
        return $this->belongsTo('App\Banksampah');
    }

    public function nasabah()
    {
        return $this->belongsTo('App\Nasabah');
    }

    public function jemput()
    {
        return $this->hasMany('App\Jemput');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
