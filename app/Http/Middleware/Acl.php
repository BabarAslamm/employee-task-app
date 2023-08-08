<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Acl
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

        $user =  auth::user();

        $user = User::with('employeeRoleOrganization.role')->find($user->id);
        $role = $user->employeeRoleOrganization->role;

        $controllerAction = class_basename(Route::currentRouteAction());
        $controllerName = explode('@', $controllerAction)[0];


        if($role->slug == 'lead')
        {
            if( $controllerName == 'MyTaskController')
            {
                abort('401');
            }

            return $next($request);

        }else{


            if( $controllerName == 'MyTaskController')
            {
                return $next($request);
            }else{
                abort('401');
            }

        }
    }
}
