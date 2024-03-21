<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TrendController extends Controller
{
    public function entryTrend()
    {
        // 定义 Redis 键名
        $key = 'entry_trend';

        // 尝试从 Redis 获取数据
        $entries = Redis::get($key);

        // 如果 Redis 中没有数据
        if (!$entries) {
            // 获取热榜数据
            $entries = visits('App\Models\Entry')->top(20);

            // 将数据转换为 JSON 并存储到 Redis，设置过期时间为 10 分钟
            Redis::setex($key, 600, json_encode($entries));
        } else {
            // 如果 Redis 中有数据，则解码 JSON
            $entries = json_decode($entries);
        }

        // 返回视图并传递数据
        return view('trend.entry_trend', compact('entries'));
    }
}
