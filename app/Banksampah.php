<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Banksampah extends Model
{
    use Notifiable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function nasabahs()
    {
        return $this->belongsToMany('App\Nasabah', 'jadwals')->withTimestamps();
    }

    public function pegawais()
    {
        return $this->hasMany('App\Pegawai');
    }

    public function kategorisampahs()
    {
        return $this->belongsToMany('App\Kategorisampah')->withPivot('price', 'id', 'status_id');
    }

    public function setorans()
    {
        return $this->hasMany('App\Setoran');
    }

    public function bankAccount()
    {
        return $this->hasMany('App\BankAccount');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public static function countActive()
    {
        return (new static)::whereHas('user', function ($query) {
                    $query->whereNotNull('activated_at');
                })->count();
    }

    public static function countVerified()
    {
        return (new static)::whereHas('user', function ($query) {
                    $query->whereNotNull('email_verified_at');
                })->count();
    }

    public static function countNonactive()
    {
        return (new static)::whereHas('user', function ($query) {
                    $query->whereNotNull('email_verified_at')->whereNull('activated_at');
                })->count();
    }
}
