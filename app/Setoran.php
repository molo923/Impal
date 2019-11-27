<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'id',
        'store_in',
        'price_total',
        'store_cost',
    ];

    protected $appends = [
        'id_pretty',
        'store_in_pretty',
        'price_total_nett',
        'price_total_nett_rp',
        'store_cost_rp',
        'total_weight',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {

            if ((int) $item->status_id === config('constants.statuses.SELESAI')) {

                $item->store_done = now();
            }
        });

        static::updating(function ($item) {

            if ($item->isDirty('status_id') && (int) $item->status_id === config('constants.statuses.SELESAI')) {

                $item->store_done = now();
            }
        });
    }

    public function getIdPrettyAttribute()
    {
        return 'S-'.str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function getStoreInPrettyAttribute()
    {
        return $this->store_in ? Carbon::createFromFormat('Y-m-d H:i:s', $this->store_in)->isoFormat('dddd, DD MMM YYYY') : null;
    }

    public function getStoreDonePrettyAttribute()
    {
        return $this->store_done ? Carbon::createFromFormat('Y-m-d H:i:s', $this->store_done)->isoFormat('dddd, DD MMM YYYY') : null;
    }

    public function getStoreInDateAttribute()
    {
        return $this->store_in ? Carbon::createFromFormat('Y-m-d H:i:s', $this->store_in)->isoFormat('L') : null;
    }

    public function getPriceTotalNettAttribute()
    {
        return ($this->price_total != 0 ? $this->price_total : $this->store_cost) - $this->store_cost;
    }

    public function getPriceTotalNettRpAttribute()
    {
        return number_format($this->price_total_nett, 0, ",", ".");
    }

    public function getStoreCostRpAttribute()
    {
        return number_format($this->store_cost, 0, ",", ".");
    }

    public function getTotalWeightAttribute()
    {
        return str_replace('.', ',', (string) $this->setoranDetail->sum('weight') + 0);
    }

    public function banksampah()
    {
        return $this->belongsTo('App\Banksampah');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai');
    }

    public function nasabah()
    {
        return $this->belongsTo('App\Nasabah');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function kategorisampahs()
    {
        return $this->belongsToMany('App\Kategorisampah', 'setoran_detail')
            ->withTimestamps()
            ->using('App\SetoranDetail')
            ->with('status');
    }

    public function setoranDetail()
    {
        return $this->hasMany('App\SetoranDetail');
    }

    public function jemput()
    {
        return $this->hasOne('App\Jemput');
    }

    public function setoranPayment()
    {
        return $this->hasOne('App\SetoranPayment');
    }

    public function getBetween($dateStart, $dateEnd)
    {
        return $this->with('setoranDetail')->where('banksampah_id', banksampah()->id)
            ->where('status_id', config('constants.statuses.SELESAI'))
            ->whereBetween('store_done', [$dateStart, $dateEnd])
            ->get();
    }

    public static function total()
    {
        return (new static)::whereHas('banksampah', function($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->with('setoranDetail')
            ->where('status_id', config('constants.statuses.SELESAI'))
            ->get()
            ->sum(function ($item) {
                return $item->setoranDetail->first()->weight;
            });
    }
}
