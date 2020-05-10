<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Karyawan
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
        if(Auth::user() && Auth::user()->roles== 'karyawan'){
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'admin') {
            return redirect('/admin');
        }
        else {
            return redirect('/admin');
        }
    }
}
