<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $guarded = [];

    protected $with = ['kategorisampah'];

    public function kategorisampah()
    {
        return $this->belongsToMany(
            'App\Kategorisampah',
            'banksampah_kategorisampah',
            'id',
            'kategorisampah_id');
    }

    public function banksampah()
    {
        return $this->belongsToMany('App\Banksampah', 'banksampah_kategorisampah', 'id', 'banksampah_id');
    }
}
