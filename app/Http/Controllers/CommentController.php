<?php

// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
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
