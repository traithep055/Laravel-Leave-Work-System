<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('loginUser')) {
            return redirect('login')->with('fail', 'You must log in first.');
        }

        return $next($request);
    }
}

