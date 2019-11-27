<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfDriver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->pegawai) {
            abort(404);
        }

        if (Auth::user()->pegawai->type !== 'driver') {
            abort(404);
        }

        return $next($request);
    }
}
