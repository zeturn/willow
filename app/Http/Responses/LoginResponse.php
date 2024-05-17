<?php
 
namespace App\Http\Responses;


use Spatie\Permission\Traits\HasRoles; 
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class LoginResponse implements LoginResponseContract
{
    use HasRoles;

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        //获取用户
        $user = Auth::user();
        setPermissionsTeamId($user->current_team_id);//这一句务必加

        // 检查用户是否有 'filament-panel' 权限
        if ($user->hasRole('SuperAdmin')) {
            $home = '/admin'; // 如果有权限，重定向到 '/admin'
        } else {
            $home = '/workstation'; // 如果没有权限，重定向到 '/workstation'
        }

        //使用session创建提示
        session()->flash('message', __('basic.login successful'));

        return redirect()->intended($home);
    }
}