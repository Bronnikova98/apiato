<?php

namespace App\Containers\UserSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\Authentication\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\UserSection\Authentication\Notifications\PasswordReset;
use App\Containers\UserSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\UserSection\Authentication\Tasks\ResetPasswordTask;
use App\Containers\UserSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\FindUserByEmailTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordAction extends ParentAction
{
    /**
     * @param ResetPasswordRequest $request
     * @return mixed
     * @throws InvalidResetPasswordTokenException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(ResetPasswordRequest $request): mixed
    {
        $dataForFill = $request->all();

        $emailForData = $dataForFill['email'];
        $user = app(FindUserByEmailTask::class)->run($emailForData);


        $sanitizedData = [
            'email' => $emailForData,
            'token' => $dataForFill['token'],
            'password' => $dataForFill['new_password'],
            'password_confirmation' => $dataForFill['new_password'],
        ];


        app(ResetPasswordTask::class)->run($sanitizedData);
        Auth::guard('web')->login($user);

        return true;

    }
}
