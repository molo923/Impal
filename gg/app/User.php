<?php

namespace App;

use App\Jobs\ResetPassword;
use App\Jobs\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'phone_number', 'status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'alamat'
    ];

    protected $appends = [
        'name'
    ];

    public function scopeActive($query)
    {
        return $query->where('status_id', config('constants.statuses.AKTIF'));
    }

    public function scopeNonactive($query)
    {
        return $query->where('status_id', config('constants.statuses.NONAKTIF'));
    }

    public function getNameAttribute()
    {
        return $this->banksampah->name ?? $this->pegawai->name ?? $this->nasabah->name;
    }

    public function getNameAbbrAttribute()
    {
        return ($this->banksampah ? abbr($this->banksampah->name) : null)
            ?? ($this->pegawai ? abbr($this->pegawai->name) : null)
            ?? ($this->nasabah ? abbr($this->nasabah->name) : null);
    }

    public function banksampah()
    {
        return $this->hasOne('App\Banksampah');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function nasabah()
    {
        return $this->hasOne('App\Nasabah');
    }

    public function pegawai()
    {
        return $this->hasOne('App\Pegawai');
    }

    public function alamat()
    {
        return $this->belongsTo('App\Alamat');
    }

    public function sendEmailVerificationNotification()
    {
        VerifyEmail::dispatch($this);
    }

    public function sendPasswordResetNotification($token)
    {
        ResetPassword::dispatch($this, $token);
    }
}
