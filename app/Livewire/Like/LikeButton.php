<?php

namespace App\Livewire\Like;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeButton extends Component
{

    public $itemId;  // 项目的ID
    public $itemType; // 项目的类型
    public $isLiked; // 是否喜爱

    public function mount($itemId, $itemType)
    {
        $this->itemId = $itemId;
        $this->itemType = $itemType;


        $this->isLiked = $this->isItemLikedByUser(Auth::user());
    }

    public function toggleLike()
    {
        if (Auth::check()) {
            $user = Auth::user();
            //dd("1");
            if ($this->isLiked) {
                // 用户已经点赞，取消点赞
                $this->removeLike($user->id);
                $this->isLiked = False;
            } else {
                // 用户未点赞，进行点赞
                $this->addLike($user->id);
                $this->isLiked = True;
            }

            //$this->isLiked = !$this->isLiked; // 切换点赞状态
            //dd($this->isLiked);
            $this->dispatch('likeButtonUpdated', $this->isLiked);
        }else{
            return redirect()->guest(route('login'));
        }
    }

    private function isItemLikedByUser($user)
    {
        // 在此处根据项目的ID、类型和用户ID检查用户是否已点赞
        // 返回 true 或 false 表示点赞状态

        if (Auth::check()) {
            $status = Like::where([
                'user_id' => $user->id,
                'model_type' => $this->itemType, // 项目的类型
                'model_id' => $this->itemId,   // 项目的ID
            ])->exists();
        }else{
            $status = false;
        }
        
        return $status;
    }

    private function addLike($userId)
    {
        // 创建一个新的点赞记录
        Like::create([
            'user_id' => $userId,
            'model_type' => $this->itemType, // 项目的类型
            'model_id' => $this->itemId,   // 项目的ID
        ]);

        //dd($this->itemId, $this->itemType);

    }

    private function removeLike($userId)
    {
        // 查找并删除用户的点赞记录
        Like::where([
            'user_id' => $userId,
            'model_type' => $this->itemType, // 项目的类型
            'model_id' => $this->itemId,   // 项目的ID
        ])->delete();

        // 设置 $isLiked 为 false，表示用户取消了点赞
        $this->isLiked = false;
    }
    public function render()
    {
        return view('livewire.like.like-button');
    }
}
