<?php


namespace App\Http\View\Composers;

use App\Bank;
use Illuminate\View\View;

class BanksComposer
{
    public function compose(View $view)
    {
        $banks = Bank::all();

        $view->with('banks', $banks);
    }
}
