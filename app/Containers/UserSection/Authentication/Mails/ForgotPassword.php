<?php

namespace App\Containers\UserSection\Authentication\Mails;

use App\Containers\UserSection\User\Models\User;
use App\Ship\Parents\Mails\Mail as ParentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends ParentMail
{

    public function __construct(
        protected User $recipient,
        protected string $token,
        protected string $reseturl
    )
    {
    }

    public function via()
    {
        return ['mail'];
    }



    public function build(): static
    {
        return $this
            ->view('userSection@authentication::forgot-password')
            ->to($this->recipient->email, $this->recipient->name)
            ->subject('Смена пароля')
            ->with([
                'token' => $this->token,
                'reseturl' => $this->reseturl,
                'email' => $this->recipient->email,
                'app_url' => config('app.url'),
            ]);
    }
}
