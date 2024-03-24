<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailVerification;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailVerification;

    public function __construct(EmailVerification $emailVerification)
    {
        $this->emailVerification =$emailVerification;
    }

    public function build()
    {
        // 生成加密的 UUID 并存储在 session 中
        $encryptedUuid =$this->emailVerification->encryptUuid($this->emailVerification->id);

        return $this->subject('邮箱验证')
                    ->markdown('emails.email-verification', ['emailVerification' => $this->emailVerification, 'encryptedUuid' => $encryptedUuid]);
    }
}
