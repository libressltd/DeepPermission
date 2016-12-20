<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class DPPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::user())
        {
            abort(401);
        }

        if (!Auth::user()->hasPermission($permission))
        {
            abort(403);
        }
        return $next($request);
    }
}
