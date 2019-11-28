<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetoranPayment extends Model
{
    protected $guarded = [];

    protected $table = 'setoran_payment';

    public function setoran()
    {
        return $this->belongsTo('App\Setoran');
    }

    public function bankAccount()
    {
        return $this->belongsTo('App\BankAccount');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public static function totalWaiting()
    {
        return (new static)::where('status_id', config('constants.statuses.MENUNGGUPEMBAYARAN'))
            ->get()
            ->count();
    }
}
