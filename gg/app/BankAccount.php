<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $guarded = [];

    public function nasabah()
    {
        return $this->belongsTo('App\Nasabah');
    }

    public function banksampah()
    {
        return $this->belongsTo('App\Banksampah');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    public function getDetailAttribute()
    {
        return $this->bank->name . ' ' . $this->number . ' a.n ' . $this->name;
    }
}
