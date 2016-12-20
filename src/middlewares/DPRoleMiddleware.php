<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class DPRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::user())
        {
            abort(401);
        }

        if (!Auth::user()->hasRole($role))
        {
            abort(403);
        }
        return $next($request);
    }
}
