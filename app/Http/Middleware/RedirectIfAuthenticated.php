<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    protected $redirectTo = '';

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            if (Auth::user()->username === 'admin') {
                return redirect(route('admin.index'));
            }

            if (Auth::user()->banksampah || Auth::user()->pegawai->type !== 'driver') {
                return redirect(route('banksampah.dashboard'));
            }

            return redirect(route('driver.index'));
        }

        return $next($request);
    }
}
