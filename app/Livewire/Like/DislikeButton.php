<?php

namespace App\Livewire\Like;

use Livewire\Component;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use App\Models\Dislike;

class DislikeButton extends Component
{

    public $itemId;  // 项目的ID 
    public $itemType; // 项目的类型
    public $isDisliked; // 是否喜爱
    public $dislikeCount; //喜爱数量

    public function mount($itemId, $itemType)
    {
        $this->itemId = $itemId;
        $this->itemType = $itemType;
        $this->isDisliked = $this->isItemDislikedByUser(Auth::user());
        $this->dislikeCount = $this->getDislikeCount();
    }

    public function getDislikeCount(){

        $cached_count = Redis::get("dislike:itemId:{$this->itemId}:itemType:{$this->itemType}:dislikecount");

        if($cached_count){
            return $cached_count;
        }else{
        $dislikeCount = DisLike::where('model_type', $this->itemType)
            ->where('model_id', $this->itemId)
            ->count();
            // 将点踩量存储到Redis中
            Redis::set("dislike:itemId:{$this->itemId}:itemType:{$this->itemType}:dislikecount",$dislikeCount);
            return $dislikeCount;
        }
    }

    public function toggleDislike()
    {
        if (Auth::check()) {
            $user = Auth::user();
            //dd("1");
            if ($this->isDisliked) {
                // 用户已经点赞，取消点赞
                $this->removeDislike($user->id);
                $this->isDisliked = False;
            } else {
                // 用户未点赞，进行点赞
                $this->addDislike($user->id);
                $this->isDisliked = True;
            }
            $this->dislikeCount = $this->dislikeCount+1;
            //$this->isDisliked = !$this->isDisliked; // 切换点赞状态
            //dd($this->isDisliked);
            $this->dispatch('dislikeButtonUpdated', $this->isDisliked);


            Redis::set("dislike:itemId:{$this->itemId}:itemType:{$this->itemType}:dislikecount",$this->dislikeCount);

            //$this->dispatch('dislikeButtonUpdated', $this->dislikeCount);
        }else{
            return redirect()->guest(route('login'));
        }
    }

    private function isItemDislikedByUser($user)
    {
        // 在此处根据项目的ID、类型和用户ID检查用户是否已点赞
        // 返回 true 或 false 表示点赞状态
 
        
        if (Auth::check()) {

            $status = Dislike::where([
            'user_id' => $user->id,
            'model_type' => $this->itemType, // 项目的类型
            'model_id' => $this->itemId,   // 项目的ID
            ])->exists();

        }else{

            $status = False;

        }

        return $status;
    }

    private function addDislike($userId)
    {
        // 创建一个新的点赞记录
        Dislike::create([
            'user_id' => $userId,
            'model_type' => $this->itemType, // 项目的类型
            'model_id' => $this->itemId,   // 项目的ID
        ]);

        //dd($this->itemId, $this->itemType);

    }

    private function removeDislike($userId)
    {
        // 查找并删除用户的点赞记录
        Dislike::where([
            'user_id' => $userId,
            'model_type' => $this->itemType, // 项目的类型
            'model_id' => $this->itemId,   // 项目的ID
        ])->delete();

        // 设置 $isDisliked 为 false，表示用户取消了点赞
        $this->isDisliked = false;

        $this->dislikeCount = $this->dislikeCount-2;//why???
        Redis::set("dislike:itemId:{$this->itemId}:itemType:{$this->itemType}:dislikecount",$this->dislikeCount);

        $this->dispatch('dislikeButtonUpdated', $this->dislikeCount);
    }

    public function render()
    {
        return view('livewire.like.dislike-button');
    }
}
