<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wall;
use App\Models\Topic;
use App\Models\Node;

use Illuminate\Support\Facades\Redis;


class ExploreController extends Controller
{
    public function entry_waterfall()
    {
        // 你的逻辑代码
        return view('explore.entry_waterfall'); // 假设你在 resources/views/explore 目录下有一个名为 index.blade.php 的视图文件
    }

    public function wallSquare()
    {
        // 定义 Redis 键名
        $key = 'walls-square';

        // 尝试从 Redis 获取数据
        $walls = Redis::get($key);

        // 如果 Redis 中没有数据
        if (!$walls) {
            // 从数据库中随机获取 30 个 Wall 记录
            $walls = Wall::inRandomOrder()->limit(30)->get();

            // 将数据转换为 JSON 并存储到 Redis，设置过期时间为 30 秒
            Redis::setex($key, 30, json_encode($walls));
        } else {
            // 如果 Redis 中有数据，则解码 JSON
            $walls = json_decode($walls);
        }

        // 返回视图并传递数据
        return view('explore.wall-square', compact('walls'));
    }

    public function NodeSquare()
    {
        // 定义 Redis 键名
        $key = 'nodes-square';

        // 尝试从 Redis 获取数据
        $nodes = Redis::get($key);

        // 如果 Redis 中没有数据
        if (!$nodes) {
            // 从数据库中随机获取 30 个 Node 记录
            $nodes = Node::inRandomOrder()->limit(30)->get();

            // 将数据转换为 JSON 并存储到 Redis，设置过期时间为 30 秒
            Redis::setex($key, 30, json_encode($nodes));
        } else {
            // 如果 Redis 中有数据，则解码 JSON
            $nodes = json_decode($nodes);
        }

        // 返回视图并传递数据
        return view('explore.node-square', compact('nodes'));
    }
}
