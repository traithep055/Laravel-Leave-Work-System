<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');
            $user = User::find($user_id);

            if (!$user || !in_array($user->role, $roles)) {
                // If user doesn't exist or doesn't have the required role, redirect them.
                return redirect('Access-denied')->with('error', 'You do not have access to this page.');
            }
        } else {
            // If loginUser is not in session, redirect them.
            return redirect('Access-denied')->with('error', 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
