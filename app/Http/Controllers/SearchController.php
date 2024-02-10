<?php

namespace App\Http\Controllers;

use App\Models\Entry; // 导入 Entry 模型
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        // 返回首页视图
        return view('search.index');
    }

    public function searchEntry(Request $request)
    {
        // 获取搜索关键词
        $query = $request->input('query');

        // 使用 Scout 进行搜索
        $entries = Entry::search($query)->get();
        //dd($entries);
        // 返回搜索结果视图
        return view('search.entry', compact('entries'));
    }
}
