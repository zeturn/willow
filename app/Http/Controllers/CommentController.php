<?php

// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:comment-index', ['only' => ['index']]);
        $this->middleware('permission:comment-create', ['only' => ['create','store']]);
        $this->middleware('permission:comment-editt', ['only' => ['edit','update']]);
        $this->middleware('permission:comment-delete-soft-delete', ['only' => ['softDelete']]);//一般用户，仅可以软删除
        $this->middleware('permission:comment-delete', ['only' => ['destroy', 'softDelete', 'restore']]);//高级用户，删除、软删除、恢复
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 尝试创建评论，并在失败时捕获异常
        try {
            // 验证请求的数据
            $validatedData =$request->validate([
                'topic_id' => 'required|exists:topics,id',
                'content' => 'required',
                'parent_id' => 'nullable|exists:comments,id'
            ]);

            // 创建评论
            Comment::create([
                'topic_id' => $validatedData['topic_id'],
                'content' => $validatedData['content'],
                'user_id' => Auth::id(),
                'parent_id' => $validatedData['parent_id'] ?? null,
                'status' => 5, // May The 5 Be With You!
            ]);

            // 设置成功消息
            session()->flash('message', 'Comment sent successfully! Please wait for review~');
        } catch (ValidationException $e) {
            // 验证错误处理
            session()->flash('error', 'Validation error occurred. Please check your input.');
        } catch (\Exception $e) {
            // 其他异常处理
            session()->flash('error', 'An error occurred while saving the comment. Please try again later.');
            // 记录日志
            Log::error('Error saving comment: ' . $e->getMessage());
        }

        // 返回上一页
        return back();
    }


    /**
     * 默认返回所在topic
     * 
     */
    public function show(Comment $comment)
    {
        $topic = $comment->topic;
        return view('topics.show', compact('topic'));
    }

    // ... 其他方法，如编辑、删除等
}
