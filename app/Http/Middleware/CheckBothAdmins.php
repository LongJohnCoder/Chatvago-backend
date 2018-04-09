<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckBothAdmins
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
       $user = Auth::user();
        if (isset($user) && !is_null($user) && $user->role == '3') {
            return redirect()->route('common.home');
        }
        return $next($request);
    }
}
