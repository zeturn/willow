@component('mail::message')
# 邮箱验证

您好 {{ $emailVerification->user->name }}，

很高兴今天能够在这里遇到您，同时感谢您注册我们的服务。请使用以下验证码完成邮箱验证：

## {{ $emailVerification->verification_key }}

如果您找不到认证入口，请带上验证码，复制以下链接到浏览器地址栏中访问：

{{ url('/EmailVerification/showEmailVerification/'.$encryptedUuid) }}

如果您没有进行此操作，请忽略此邮件，您的电子邮件是安全的。

玩的愉快！

{{config('app.name', 'memeGit')}}
2024

@endcomponent
