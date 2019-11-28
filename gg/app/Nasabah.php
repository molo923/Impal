<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $guarded = [];

//    protected $with = [
//        'user'
//    ];

    public function getGenderAttribute($value)
    {
        return $value === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function banksampahs()
    {
        return $this->belongsToMany('App\Banksampah', 'jadwals')->withTimestamps();
    }

    public function setorans()
    {
        return $this->hasMany('App\Setoran');
    }

    public function jadwals()
    {
        return $this->hasMany('App\Jadwal');
    }

    public function jadwal()
    {
        return $this->jadwals->where('banksampah_id', banksampah()->id)->first();
    }

    public static function total()
    {
        return (new static)::whereHas('banksampahs', function($query) {
            $query->where('banksampah_id', banksampah()->id);
        })->get()->count();
    }
}
