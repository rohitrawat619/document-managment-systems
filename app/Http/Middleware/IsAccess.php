<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class IsAccess
{
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->is_admin==1)
            {
                Session::put('user_permissions', [2,3,3,54,54]);
                return $next($request);
            }
            else
            {
                $user = Auth::user();
                $role = Role::find($user->role_id);

                if ($role && !empty($role->permission_id)) {
                    $permissions = explode(',', $role->permission_id); 
                    Session::put('user_permissions', $permissions);
                } else {
                    $permissions = [];
                }
            }
        }
        else
        {
            return redirect()->route('admin.login');
        }


    }
}