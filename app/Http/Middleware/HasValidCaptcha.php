<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

final readonly class HasValidCaptcha
{
    public function handle(Request $request, Closure$next): Response
    {
        // 从请求中获取cf-turnstile-response字段的值
        $turnstileCode =$request->input('cf-turnstile-response');
    
        // 检查turnstileCode是否为null
        if ($turnstileCode === null) {
            // 如果为null，则返回404响应
            abort(404);
        }
    
        // 如果不为null，则进行turnstile验证
        if (!$this->turnstileCodeIsValid($turnstileCode)) {
            // 如果验证失败，则返回400响应
            abort(400);
        }
    
        // 如果验证成功，则继续处理请求
        return $next($request);
    }
    

    /**
     * Make an HTTP call to the Turnstile API to verify the code.
     */
    private function turnstileCodeIsValid(string $turnstileCode): bool
    {
        return Http::post(
            url: 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            data: [
                'secret' => config('services.cloudflare.turnstile.site_secret'),
                'response' => $turnstileCode,
            ]
        )->json('success');
    }
}