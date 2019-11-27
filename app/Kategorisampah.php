<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorisampah extends Model
{
    protected $guarded = [];

    protected $with = [
        'jenissampah',
    ];

//    protected $appends = [
//        'total_weight_minus',
//    ];

    public function scopeActive($query)
    {
        return $query->where('status_id', config('constants.statuses.AKTIF'));
    }

    public function getPriceRpAttribute()
    {
        return "Rp " . number_format($this->banksampahKategorisampah->first()->price, 0, ",", ".");
    }

    public function banksampahs()
    {
        return $this->belongsToMany('App\Banksampah')
            ->withPivot('price', 'id', 'status_id')
            ->where('banksampah_id', banksampah()->id);
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function setorans()
    {
        return $this->belongsToMany('App\Setoran', 'setoran_detail')
            ->where('banksampah_id', banksampah()->id)
            ->withTimestamps();
    }

    public function sampahkeluars()
    {
        return $this->belongsToMany('App\Sampahkeluar', 'sampahkeluar_details')
            ->withTimestamps();
    }

    public function jenissampah()
    {
        return $this->belongsTo('App\Jenissampah');
    }

    public function setoranDetail()
    {
        return $this->hasMany('App\SetoranDetail');
    }

    public function sampahkeluarDetail()
    {
        return $this->hasMany('App\SampahkeluarDetail');
    }

    public function banksampahKategorisampah()
    {
        return $this->hasMany('App\BanksampahKategorisampah')
            ->where('banksampah_id', banksampah()->id);
    }

    public function transfer()
    {
        return $this->hasMany('App\Mutasisampah', 'kategorisampah_transfer_id');
    }

    public function terima()
    {
        return $this->hasMany('App\Mutasisampah', 'kategorisampah_terima_id');
    }

    public function stok()
    {
        return $this->belongsToMany(
            'App\Stok',
            'banksampah_kategorisampah',
            'kategorisampah_id',
            'id',
            '',
            'banksampah_kategorisampah_id')
            ->where('banksampah_id', '=', banksampah()->id);
    }

    public function residu()
    {
        return $this->hasMany('App\Residusampah', 'banksampah_kategorisampah_id');
    }

    public function getTotalWeight()
    {
        return $this->stok->first()->quantity_beli
            + $this->stok->first()->quantity_tabungan
            + $this->stok->first()->quantity_hibah
            - $this->stok->first()->quantity_mutasi_transfer
            + $this->stok->first()->quantity_mutasi_terima
            + $this->stok->first()->quantity_retur;
    }

    public function getTotalWeightMinus()
    {
        return $this->stok->first()->quantity_beli
            + $this->stok->first()->quantity_hibah
            + $this->stok->first()->quantity_tabungan
            - $this->stok->first()->quantity_mutasi_transfer
            + $this->stok->first()->quantity_mutasi_terima
            - $this->stok->first()->quantity_jual
            - $this->stok->first()->quantity_nonjual
            - $this->stok->first()->quantity_jual_reject
            - $this->stok->first()->quantity_reject
            - $this->stok->first()->quantity_residu
            + $this->stok->first()->quantity_retur;
    }

    public function getTotalWeightMinusAttribute()
    {
        return $this->getTotalWeightMinus();
    }

    public static function totalActive()
    {
        return (new static)::whereHas('banksampahKategorisampah', function($query) {
            $query->where('banksampah_id', banksampah()->id);
        })->get()->count();
    }
}
