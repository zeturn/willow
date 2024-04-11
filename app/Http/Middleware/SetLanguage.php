<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            // 如果用户已登录，根据用户的profile中的设置来配置语言
            $user = auth()->user();
            $userLanguage = $user->profile->language ?? null;
            if ($userLanguage) {
                App::setLocale($userLanguage);
            }else{
                // 根据浏览器语言设置来配置语言
                $browserLanguage = $request->getPreferredLanguage(['en', 'zh']); // 定义语言偏好列表
                App::setLocale($browserLanguage);

                if($browserLanguage == 'zh'){
                    App::setLocale('zh_CN');
                }
            }
        } else {
            // 如果用户未登录，根据浏览器语言设置来配置语言
            $browserLanguage = $request->getPreferredLanguage(['en', 'zh']); // 定义语言偏好列表
            App::setLocale($browserLanguage);

            if($browserLanguage == 'zh'){
                App::setLocale('zh_CN');
            }
        }

        return $next($request);
    }
}
