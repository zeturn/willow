<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Auth;

class TeamsPermission
{
    
    public function handle($request, \Closure $next){
        $user = Auth::user();

        if(!empty($user = auth()->user()) && !empty($user->current_team_id)){
            
            // session value set on login
            setPermissionsTeamId($user->current_team_id);
        }
        // other custom ways to get team_id
        /*if(!empty(auth('api')->user())){
            // `getTeamIdFromToken()` example of custom method for getting the set team_id 
            setPermissionsTeamId(auth('api')->user()->getTeamIdFromToken());
        }*/
        
        return $next($request);
    }
}