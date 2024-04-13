<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    public function __construct()
    {
        // 确保除了 show 方法以外的所有方法用户都必须登录
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        $articles = Article::all();
        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        // 返回创建文章的视图
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // 将当前用户的 user_id 赋值给文章
        $validatedData['user_id'] = Auth::id();

        // 创建文章
        $article = Article::create($validatedData);

        // 重定向到文章详情页
        return redirect()->route('articles.show', ['article' => $article->id]);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', [
            'article' => $article,
            'content' => Str::markdown($article->content),
        ]);
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        // 确保用户只能编辑自己的文章
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 返回编辑文章的视图
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|max:255',
            'content' => 'sometimes|required',
        ]);

        $article = Article::findOrFail($id);

        // 确保用户只能编辑自己的文章
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 更新文章
        $article->update($validatedData);

        // 重定向到文章详情页
        return redirect()->route('articles.show', ['article' => $article->id]);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // 确保用户只能删除自己的文章
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 删除文章
        $article->delete();

        // 重定向到文章列表页
        return redirect()->route('articles.index');
    }
}
