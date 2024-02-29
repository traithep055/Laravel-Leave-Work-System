<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');
            $user = User::find($user_id);  // Retrieve the user from the database

            if ($user) {
                view()->share('user_role', $user->role);
            } else {
                view()->share('user_role', null);
            }
        } else {
            view()->share('user_role', null);
        }

        return $next($request);
    }
}
