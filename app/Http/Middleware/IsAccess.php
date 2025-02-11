<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
            if(Auth::user()->is_admin==1)
                return $next($request);
            else
            {
                if(Auth::user()->role_id==1)
                {
                    if($request->routeIs('admin.users.*') || $request->routeIs('admin.divisions.*') || $request->routeIs('admin.designations.*') || $request->routeIs('admin.permissions.*'))
                        return $next($request);
                    else
                        return abort(403);
                }
                else
                {
                    return abort(403);
                }
            }
        }
        else
        {
            return redirect()->route('admin.login');
        }
    }
}
