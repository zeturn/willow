<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
use App\Traits\UUID;
use App\Traits\Status;
use Illuminate\Support\Facades\Crypt;

class EmailVerification extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = ['user_id', 'verification_key', 'verification_type'];

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
        Mail::to($this->user->email)->send(new EmailVerificationMail($this));
    }
}
