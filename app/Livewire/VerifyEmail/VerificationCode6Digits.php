<?php

namespace App\Livewire\VerifyEmail;

use Livewire\Component;
use App\Models\User; // 确保你已经使用了User模型
use Carbon\Carbon; // 使用Carbon来处理时间
use Illuminate\Support\Facades\DB; // 引入DB门面

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
        // Here you would add your verification logic.
        // For demonstration purposes, we'll just check if the key is 'valid'.
        $this->key =$key;
        if ($this->key === $this->emailVerification->verification_key) {
            // 获取用户对象
            $user = User::find($this->emailVerification->user_id);

            if ($user) {
                // 更新用户的email_verified_at字段
                $user->email_verified_at = Carbon::now();
                $user->save(); // 保存用户

                $this->step = 2;
                $this->error = '';
            } else {
                $this->error = '用户未找到，验证失败。';
            }
        } else {
            $this->error = '验证失败，请输入正确的验证码。';
        }
    }

    public function render()
    {
        return view('livewire.verify-email.verification-code6-digits');
    }
}
