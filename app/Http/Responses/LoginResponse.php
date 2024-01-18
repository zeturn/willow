<?php
 
namespace App\Http\Responses;


use Spatie\Permission\Traits\HasRoles; 
use Illuminate\Support\Facades\Gate;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
 
class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // 检查用户是否有 'filament-panel' 权限
        if (Gate::allows('filament-panel')) {
            $home = '/admin'; // 如果有权限，重定向到 '/admin'
        } else {
            $home = '/workstation'; // 如果没有权限，重定向到 '/dashboard'
        }

        return redirect()->intended($home);
    }
}