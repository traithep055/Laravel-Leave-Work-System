<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NowLogin
{
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('loginUser') && (url('login') == $request->url() || url('registration') == $request->url())) {
            return redirect('dashboard')->with('info', 'You are already logged in.');

        }
        return $next($request);
    }
}

