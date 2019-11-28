<?php


namespace App\Http\View\Composers;

use App\Jenissampah;
use Illuminate\View\View;

class StatusesComposer
{
    public function compose(View $view)
    {
        $jenissampahs = Jenissampah::all();

        $view->with('jenissampahs', $jenissampahs);
    }
}
