<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailVerification;


class EnsureEmailIsVerified
{
    protected $exceptRoutes = ['EmailVerification.showEmailVerification'];

    public function __construct($exceptRoutes = [])
    {
        $this->exceptRoutes =$exceptRoutes;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 检查当前路由是否在排除列表中
        if (in_array($request->route()->getName(),$this->exceptRoutes)) {
            return $next($request);
        }

        // 检查用户是否已登录
        if (Auth::check() && is_null(Auth::user()->email_verified_at)) {
            // 用户已登录但邮箱未验证，查询最近一次创建的EmailVerification
            $emailVerification = EmailVerification::where('user_id', Auth::id())
                ->latest()
                ->first();

            if ($emailVerification) {
                // 生成加密的 UUID 并存储在 session 中
                $encryptedUuid =$emailVerification->encryptUuid($emailVerification->id);
                $request->session()->put('email_verification_uuid',$encryptedUuid);

                //dd($encryptedUuid);
                // 重定向用户到邮箱验证页面
                return redirect()->route('EmailVerification.showEmailVerification', ['session' => $encryptedUuid]);
            }
        }

        // 如果用户已验证邮箱或未登录，继续请求
        return $next($request);
    }
}
