<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Jemput extends Model
{
    protected $guarded = [];

    /*public function generatePickUpDate()
    {
        $dateCreated = $this->created_at; //Carbon Obj
        $weeks = explode(';', $this->jadwal->weeks);
        $days = explode(';', $this->jadwal->days);

        if (!in_array($dateCreated->weekOfMonth, $weeks)) {

            if (len($weeks) > 1) {
                for ($i = 0; $i < len($weeks); $i++) {
                    if ($dateCreated->weekOfMonth < $weeks[$i]) {
                        $dateCreated->addWeek($weeks[$i] - $dateCreated->weekOfMonth);
                    }

                    if ($dateCreated->weekOfMonth )

                    if ($dateCreated->dayOfWeek > $days[$i]) {
                        $dateCreated->subDay($dateCreated->dayOfWeek - $days[$i]);
                    }

                    if ($dateCreated->dayOfWeek < $days[$i]) {
                        $dateCreated->addDay($days[$i] - $dateCreated->dayOfWeek);
                    }
                }
            }
        }

        return $dateCreated;
    }*/

    private function generatePickUpDate()
    {
        return now()->addDay();
    }

    public function setDatePickUpAttribute($value)
    {
        $this->attributes['date_pick_up'] = $this->generatePickUpDate();
    }

    public function getIdPrettyAttribute()
    {
        return 'J-'.str_pad($this->id, 5, 0, STR_PAD_LEFT);
    }

    public function jadwal()
    {
        return $this->belongsTo('App\Jadwal');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function setoran()
    {
        return $this->belongsTo('App\Setoran');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai');
    }
}
