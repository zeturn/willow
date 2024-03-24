<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\EmailVerification;

class EmailVerificationController extends Controller
{

    //传入session
    public function showEmailVerification($session)
    {
        // 解码session
        $decryptedSession = Crypt::decrypt($session);
        // 分割字符串以获取uuid
        $parts = explode('🔐',$decryptedSession);
        $uuid =$parts[0];
    
        // 查找EmailVerification对象
        $emailVerification = EmailVerification::where('id',$uuid)->first();
    
        if ($emailVerification) {
            // 根据verification_type返回对应的视图和EmailVerification对象
            switch ($emailVerification->verification_type) {
                case 1:
                    return view('auth.verify-email.verificationCode4Digits', compact('emailVerification'));
                    break;
                case 2:
                    return view('auth.verify-email.verificationCode4Letters', compact('emailVerification'));
                    break;
                case 3:
                    return view('auth.verify-email.verificationCode6Digits', compact('emailVerification'));
                    break;
                case 4:
                    return view('auth.verify-email.verificationCode6Letters', compact('emailVerification'));
                    break;
                case 5:
                    return view('auth.verify-email.verificationCode6Mixed', compact('emailVerification'));
                    break;
                case 6:
                    return view('auth.verify-email.doubleHashedVerification', compact('emailVerification'));
                    break;
                case 7:
                    return view('auth.verify-email.singleHashedVerification', compact('emailVerification'));
                    break;
                default:
                    // 如果verification_type不符合预期，可以返回错误视图或进行其他处理
                    return view('errors.verification-type-error');
                    break;
            }
        } else {
            // 如果没有找到EmailVerification对象，可以返回错误视图或进行其他处理
            return view('errors.email-verification-not-found');
        }
    }

    //待启用
    public function createEmailVerification($verificationType)
    {
        $emailVerification = new EmailVerification();

        // 根据verification_type生成verification_key
        switch ($verificationType) {
            case 1: // 四位数值
                $emailVerification->verification_key = rand(1000, 9999);
                break;
            case 2: // 四位字母
                $emailVerification->verification_key = Str::upper(Str::random(4));
                break;
            case 3: // 六位数值
                $emailVerification->verification_key = rand(100000, 999999);
                break;
            case 4: // 六位字母
                $emailVerification->verification_key = Str::upper(Str::random(6));
                break;
            case 5: // 六位混合
                $emailVerification->verification_key = Str::random(6);
                break;
            case 6: // 双层哈希
                $emailVerification->verification_key = hash('sha256', hash('sha256', Str::random(64)));
                break;
            case 7: // 单层哈希
                $emailVerification->verification_key = hash('sha256', Str::random(64));
                break;
            default:
                // 如果verification_type不符合预期，可以抛出异常或进行其他处理
                throw new InvalidArgumentException('Invalid verification type.');
                break;
        }

        // 设置其他必要的属性
        $emailVerification->verification_type =$verificationType;
        $emailVerification->uuid = Str::uuid(); // 生成UUID

        // 保存EmailVerification对象到数据库
        $emailVerification->save();

        // 返回创建的EmailVerification对象
        return $emailVerification;
    }
    
    public function verifyEmail(Request $request)
    {

        $user = Auth::user();

        // 检查验证码是否正确和是否过期
        $emailVerification =$user->emailVerifications()
            //->where('verification_key', $request->verification_key)
            ->where('expires_at', '>', now())
            ->first();

        if ($emailVerification) {
            // 验证码正确，更新用户邮箱验证状态
            $user->email_verified_at = now();
            $user->save();

            // 可以选择删除已使用的验证码记录
            $emailVerification->delete();

            return redirect()->route('home')->with('status', '邮箱验证成功！');
        }

        return back()->withErrors(['verification_code' => '验证码无效或已过期。']);
    }
}
