<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserProfileController extends Controller
{
    /**
     * 显示用户个人资料屏幕。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request)
    {
        try {
            // 检查用户是否已登录
            if (!$request->user()) {
                // 如果用户未登录，重定向到登录页面
                return redirect()->route('login');
            }

            // 如果用户已登录，返回个人资料视图
            return view('profile.show', [
                'request' => $request,
                'user' => $request->user(),
            ]);
        } catch (\Exception $e) {
            // 记录错误日志
            \Log::error($e->getMessage());

            // 发生其他异常时，返回错误视图
            return view('errors.500');
        }
    }

    /**
     * 编辑用户个人资料。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function basic_info_edit(Request $request)
    {
        try {
            // 检查用户是否已登录
            if (!$request->user()) {
                // 如果用户未登录，重定向到登录页面
                return redirect()->route('login');
            }

            // 如果用户已登录，返回基本资料编辑视图
            return view('profile.basic-info', [
                'request' => $request,
                'user' => $request->user(),
            ]);
        } catch (\Exception $e) {
            // 记录错误日志
            \Log::error($e->getMessage());

            // 发生其他异常时，返回错误视图
            return view('errors.500');
        }
    }

}
