<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockUserAgent
{
    /**
     * ------------------------------------------
     * 屏蔽特定UA
     * ------------------------------------------
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure$next)
    {
        $userAgent =$request->server('HTTP_USER_AGENT');
        $blockList = [
            'BadCrawler/1.0',
            'Mozilla',//单独的，只有Mozilla
            'Java 1.7.43_u43',
            'BIZCO EasyScraping Studio 2.0',
            'wget',
            'curl',
            'libcurl',
            'AnotherBadBot',
            #'AhrefsBot',
            #'AhrefsBot/7.0',
        ];

        if (in_array($userAgent,$blockList)) {
            // 可以返回403禁止访问，或者重定向到其他页面
            abort(418, 'I am a teapot :)');
        }

        return $next($request);
    }
}