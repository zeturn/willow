<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfile($id)
    {
        // 获取用户信息
        $user = User::find($id);

        // 如果用户不存在，可以根据实际情况处理，比如重定向到404页面
        if (!$user) {
            abort(404);
        }

        // 返回用户profile视图，并将用户信息传递给视图
        return view('user.profile', ['user' => $user]);
    }
}
