<?php

namespace App\Http\Controllers\Banksampah;

use App\Sampahkeluar;
use App\Setoran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinansialController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', [Setoran::class, Sampahkeluar::class]);

        return view('banksampah.finansial.index', [
            'title' => 'Finansial',
        ]);
    }
}
