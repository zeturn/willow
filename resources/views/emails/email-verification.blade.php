@component('mail::message')
# 邮箱验证

您好 {{ $emailVerification->user->name }}，

感谢您注册我们的服务。请使用以下验证码完成邮箱验证：

{{ $emailVerification->verification_key }}

如果您找不到认证入口，请复制以下链接到浏览器地址栏中访问：

{{ url('/EmailVerification/showEmailVerification/'.$encryptedUuid) }}

如果您没有进行此操作，请忽略此邮件，您的电子邮件是安全的。

祝您使用愉快！

memeGit
此致，敬礼！

@endcomponent
