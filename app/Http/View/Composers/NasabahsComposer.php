<?php


namespace App\Http\View\Composers;

use App\Nasabah;
use Illuminate\View\View;

class NasabahsComposer
{
    public function compose(View $view)
    {
        $nasabahs = Nasabah::whereHas('banksampahs', function ($query) {
            $query->where('banksampah_id', banksampah()->id);
        })->get();

        $view->with('nasabahs', $nasabahs);
    }
}
