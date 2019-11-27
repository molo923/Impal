<?php


namespace App\Http\View\Composers;

use App\BanksampahKategorisampah;
use App\Kategorisampah;
use Illuminate\View\View;

class KategorisampahsComposer
{
    public function compose(View $view)
    {
        $kategorisampahs = Kategorisampah::whereHas('banksampahs', function($query) {
            $query->where('banksampah_id', banksampah()->id)->where('banksampah_kategorisampah.status_id', config('constants.statuses.AKTIF'));
        })->active()->get();

        $banksampah_kategorisampah = BanksampahKategorisampah::where('banksampah_id', banksampah()->id)->get()->isEmpty();

        $view->with('kategorisampahs', $kategorisampahs)->with('banksampah_kategorisampah', $banksampah_kategorisampah);
    }
}
