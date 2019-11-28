<?php

namespace App;

use App\Scopes\BanksampahScope;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $guarded = [];

    public function getGenderAttribute($value)
    {
        return $value === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function banksampah()
    {
        return $this->belongsTo('App\Banksampah');
    }

    public function setorans()
    {
        return $this->hasMany('App\Setoran');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public static function total()
    {
        return (new static)::whereHas('banksampah', function($query) {
            $query->where('banksampah_id', banksampah()->id);
        })->get()->count();
    }
}
