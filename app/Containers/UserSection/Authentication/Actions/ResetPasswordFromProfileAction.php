<?php

namespace App\Containers\UserSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\Authentication\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\UserSection\Authentication\Notifications\PasswordReset;
use App\Containers\UserSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\UserSection\Authentication\Tasks\ResetPasswordTask;
use App\Containers\UserSection\Authentication\UI\API\Requests\ResetPasswordFromProfileRequest;
use App\Containers\UserSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use App\Containers\UserSection\User\Tasks\FindUserByEmailTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordFromProfileAction
{

    /**
     * @param ResetPasswordRequest $request
     * @return mixed
     * @throws InvalidResetPasswordTokenException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(ResetPasswordFromProfileRequest $request): mixed
    {
        $dataForFill = $request->all();
        $user = Auth::guard('web')->user();

        $token = app(CreatePasswordResetTokenTask::class)->run($user);


        $emailForData = $user->getEmail();
        $sanitizedData = [
            'email' => $emailForData,
            'token' => $token,
            'password' => $dataForFill['new_password'],
            'password_confirmation' => $dataForFill['new_password'],
        ];

        return app(ResetPasswordTask::class)->run($sanitizedData);
    }
}