<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $userType;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $userType)
    {
        $this->token = $token;
        $this->userType = $userType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.forgetPassword')
                    ->with([
                        'token' => $this->token,
                        'userType' => $this->userType,
                    ])
                    ->to($this->to)  // Set the recipient email dynamically
                    ->subject('Reset Password');
    }
}
