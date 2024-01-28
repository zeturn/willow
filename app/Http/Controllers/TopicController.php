<?php

// app/Http/Controllers/TopicController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wall;
use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return view('topics.index', compact('topics'));
    }

    public function create()
    {
        $walls = Wall::all();
        return view('topics.create', compact('walls'));
    }

    public function store(Request $request)
    {
        // 创建新的 Topic
        $topic = Topic::create([
            'wall_id' => $request->wall_id,
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $request->name, // 确保这里的 slug 是唯一的
            'user_id' => Auth::id(),
            'status' => 5, // May The 5 Be With You!
        ]);
    
        // 确保你的路由定义中有 'topic.show' 路由，且接受一个参数
        // 重定向到 show 方法，并传递新创建的 Topic 的 ID
        return redirect()->route('topic.show', ['topic' => $topic->id]);
    }
    

    public function edit(Topic $topic)
    {
        $walls = Wall::all();
        return view('topics.edit', compact('topic', 'walls'));
    }

    public function update(Request $request, Topic $topic)
    {
        $topic->update($request->all());
        return redirect()->route('topic.index');
    }

    public function show(Topic $topic)
    {
        $comments = $topic->comments()->paginate(10); // 分页显示，每页10条
        return view('topics.show', compact('topic', 'comments'));
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return back();
    }
}
