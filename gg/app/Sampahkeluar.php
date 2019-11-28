<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sampahkeluar extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'id',
        'date_in',
        'price_total',
        'extra_cost',
    ];

    protected $appends = [
        'id_pretty',
        'date_in_pretty',
        'price_total_nett',
        'price_total_nett_rp',
        'extra_cost_rp',
        'total_weight'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {

            if ((int) $item->status_id === config('constants.statuses.SELESAI')) {

                $item->date_done = now();
            }
        });

        static::updating(function ($item) {

            if ($item->isDirty('status_id') && (int) $item->status_id === config('constants.statuses.SELESAI')) {

                $item->date_done = now();
            }
        });
    }

    public function getIdPrettyAttribute()
    {
        return 'SK-'.str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function getDateInPrettyAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date_in)->isoFormat('dddd, DD MMM YYYY');
    }

    public function getDateDonePrettyAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date_done)->isoFormat('dddd, DD MMM YYYY');
    }

    public function getDateInDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date_in)->isoFormat('L');
    }

    public function getPriceTotalNettAttribute()
    {
        return $this->price_total - $this->extra_cost;
    }

    public function getPriceTotalNettRpAttribute()
    {
        return number_format($this->price_total_nett, 0, ",", ".");
    }

    public function getExtraCostRpAttribute()
    {
        return number_format($this->extra_cost, 0, ",", ".");
    }

    public function getTotalWeightAttribute()
    {
        return $this->sampahkeluarDetail->sum('weight');
    }

    public function banksampah()
    {
        return $this->belongsTo('App\Banksampah');
    }

    public function kategorisampahs()
    {
        return $this->belongsToMany('App\Kategorisampah', 'sampahkeluar_details')
            ->withTimestamps()
            ->using('App\SampahkeluarDetail')
            ->with('status');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function sampahkeluarDetail()
    {
        return $this->hasMany('App\SampahkeluarDetail');
    }

    public function getBetween($dateStart, $dateEnd)
    {
        return $this->with('sampahkeluarDetail')->where('banksampah_id', banksampah()->id)
            ->where('status_id', config('constants.statuses.SELESAI'))
            ->whereBetween('date_done', [$dateStart, $dateEnd])
            ->get();
    }

    public static function total()
    {
        return (new static)::whereHas('banksampah', function($query) {
                $query->where('banksampah_id', banksampah()->id);
            })
            ->with('sampahkeluarDetail')
            ->where('status_id', config('constants.statuses.SELESAI'))
            ->get()
            ->sum(function ($item) {
                return $item->sampahkeluarDetail->first()->weight;
            });
    }
}
