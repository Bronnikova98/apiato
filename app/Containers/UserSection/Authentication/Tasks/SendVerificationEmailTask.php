<?php

namespace App\Containers\UserSection\Authentication\Tasks;

use App\Ship\Contracts\MustVerifyEmail;
use App\Ship\Parents\Tasks\Task as ParentTask;

class SendVerificationEmailTask extends ParentTask
{
    public function run(MustVerifyEmail $user, ?string $verificationUrl = null): void
    {
        if (config('userSection-authentication.require_email_verification') && !$user->hasVerifiedEmail() && !is_null($verificationUrl)) {
            $user->sendEmailVerificationNotificationWithVerificationUrl($verificationUrl);
        }
    }
}
