<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $guarded = [];

    protected $appends = [
        'full_address'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function getFullAddressAttribute()
    {
        return $this->address . ' ' . $this->urban . ' ' . $this->districts . ' ' . $this->city;
    }
}
