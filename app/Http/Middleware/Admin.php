<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Admin
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
        if(Auth::user() && Auth::user()->roles== 'admin'){
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'karyawan') {
            return redirect('/');
        }
        else{
            return redirect('/');
        }
    }
}
