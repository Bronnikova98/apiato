<?php

namespace App\Containers\UserSection\Authentication\Tasks;

use App\Containers\UserSection\Authentication\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\UserSection\Authentication\Notifications\PasswordReset;
use App\Containers\UserSection\User\Tasks\FindUserByEmailTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordTask
{
    public function run(array $sanitizedData)
    {
        $status = Password::broker()->reset(
            $sanitizedData,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        switch ($status) {
            case Password::INVALID_TOKEN:
                throw new InvalidResetPasswordTokenException();
            case Password::INVALID_USER:
                throw new NotFoundException('User Not Found.');
            case Password::PASSWORD_RESET:
                $user = app(FindUserByEmailTask::class)->run($sanitizedData['email']);
                $user->notify(new PasswordReset());

                return $status;
            default:
                throw new UpdateResourceFailedException();
        }
    }
}
