<?php

namespace App\Livewire\Discuss;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Comment;

class CommentList extends Component
{
    use WithPagination;

    public $topicId;

    public $LScomments = [];
    public $LFcomment;//modal里显示的
    public $selectedCommentId;
    public $selectedCommentUserId;

    public $commentBoadrd = false;

    protected $listeners = ['refreshComments' => '$refresh'];

    public function mount($topicId)
    {
        $this->topicId = $topicId;
    }

    public function render()
    {
        return view('livewire.discuss.comment-list',[
            'LFcomments' => Comment::where('topic_id', $this->topicId)
            ->whereNull('parent_id')
            ->paginate(10),
        ]);
    }

    public function getChildrenComments($commentId)
    {
        $this->LFcomment = Comment::where('id',$commentId)->first();
        $this->selectedCommentId = $commentId;
        $this->LScomments = $this->LFcomment->getAllChildrenComments($commentId);
    }

    public function selectComment($selectedCommentId,$selectedCommentUserId){
        $this->selectedCommentId = $selectedCommentId;
        $this->selectedCommentUserId = $selectedCommentUserId;
        $this->commentBoadrd = true;
    }

    public function closeModal(){
        $this->selectedCommentId = '';
        $this->commentBoadrd = false;
        $this->LScomments = [];
    }
}
