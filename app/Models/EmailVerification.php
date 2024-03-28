<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mail\EmailVerificationMail;
use App\Traits\UUID;
use App\Traits\Status;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class EmailVerification extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = ['user_id', 'verification_key', 'verification_type','action_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //密钥加密 获取session
    public function encryptUuid($uuid)
    {
        $suffix = '🔐👋🏻';// 定义要结合的字符串
        $combined =$uuid . $suffix;// 将UUID与后缀结合
        $encrypted = Crypt::encrypt($combined);

        return $encrypted;
    }

    //发送验证邮件
    public function sendVerificationEmail()
    {
        // 使用Eloquent查找用户
        $user = Auth::user();
        // 从Redis中读取用户的新邮箱
        $newEmail = Redis::get("user:{$user->id}:new_email");

        if($this->action_type == 0){//注册
            Mail::to($this->user->email)->send(new EmailVerificationMail($this));            
        }else{//更新邮箱
            Mail::to($newEmail)->send(new EmailVerificationMail($this));   
        }

    }
}
