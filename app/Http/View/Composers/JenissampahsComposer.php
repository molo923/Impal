<?php


namespace App\Http\View\Composers;

use App\Status;
use Illuminate\View\View;

class JenissampahsComposer
{
    public function compose(View $view)
    {
        $statuses = Status::all();

        $view->with('statuses', $statuses);
    }
}
