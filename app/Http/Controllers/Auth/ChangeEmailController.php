<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ChangeEmailController extends Controller
{
    public function changeEmailForm(){
        // 使用Eloquent查找用户
        $user = Auth::user();
        return view('auth.change-email.change-email', compact('user'));
    }

    // 处理修改邮箱请求
    public function changeEmail(Request $request)
    {
        $user = Auth::user();

        // 验证密码
        if (!Hash::check($request->password,$user->password)) {
            return back()->withErrors(['password' => 'The provided password is incorrect.']);
        }

        // 验证新邮箱
        $validator = Validator::make($request->all(), [
            'new_email' => 'required|string|email|max:255|unique:users,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // 创建EmailVerification对象
        $emailVerification = new EmailVerification;
        $emailVerification->user_id =$user->id;
        $emailVerification->verification_key = rand(100000, 999999); // 生成一个随机密钥
        $emailVerification->verification_type = 3; // 指定验证类型 3.六位数字
        $emailVerification->action_type = 1; //动作类型 0.注册 1.修改邮箱
        $emailVerification->save();
        $emailVerification->sendVerificationEmail(); // 发送验证邮件


        // 将用户ID和新邮箱存储到Redis中
        Redis::set("user:{$user->id}:new_email",$request->new_email);

        // 这里可以添加发送确认邮件的逻辑
        $encryptedUuid =$emailVerification->encryptUuid($emailVerification->id);
        $request->session()->put('email_verification_uuid',$encryptedUuid);

        return redirect()->route('EmailVerification.showEmailVerification', ['session' => $encryptedUuid])->with('success', 'Your email has been updated. Please check your new email for confirmation.');
    }
}
