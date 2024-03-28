<?php

namespace App\Livewire\ChangeEmail;

use Livewire\Component;
use App\Models\User; // 确保你已经使用了User模型
use Carbon\Carbon; // 使用Carbon来处理时间
use Illuminate\Support\Facades\DB; // 引入DB门面
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class VerificationCode6Digits extends Component
{
    public $key = '';
    public $step = 1; // 1 for input, 2 for success message
    public $error = '';
    public $emailVerification; // 添加emailVerification属性

    public function mount($emailVerification) // 修改mount方法来接收emailVerification
    {
        $this->emailVerification =$emailVerification;
    }

    public function updateKey($value)
    {
        $this->key =$value;
    }

    public function verify($key)
    {
        // 使用Eloquent查找用户
        $user = Auth::user();
        // 从Redis中读取用户的新邮箱
        $newEmail = Redis::get("user:{$user->id}:new_email");

        if ($newEmail) {

            $this->key =$key;
            if ($this->key === $this->emailVerification->verification_key) {
                // 获取用户对象
                $user = User::find($this->emailVerification->user_id);

                if ($user) {
                    $user->email = $newEmail;
                    $user->save();

                    // 清除Redis中的缓存邮箱
                    Redis::del("user:{$user->id}:new_email");

                    $this->step = 2;

                } else {
                    // 用户未找到
                    $this->error = '用户未找到，验证失败。';
                }

            } else {
                $this->error = '验证失败，请输入正确的验证码。';
            }
        } else {
            // Redis中没有找到邮箱
            $this->error = '验证时间过长，请重试';
        }
    }

    public function render()
    {
        return view('livewire.verify-email.verification-code6-digits');
    }
}
