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

    public function store(Request $request)
    {
        Comment::create([
            'topic_id' => $request->topic_id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'status' => 5, // May The 5 Be With You!
        ]);
        return back();
    }

    // ... 其他方法，如编辑、删除等
}
