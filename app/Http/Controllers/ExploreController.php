<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function entry_waterfall()
    {
        // 你的逻辑代码
        return view('explore.entry_waterfall'); // 假设你在 resources/views/explore 目录下有一个名为 index.blade.php 的视图文件
    }
}
