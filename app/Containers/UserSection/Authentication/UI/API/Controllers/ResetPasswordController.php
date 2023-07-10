<?php

namespace App\Containers\UserSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\Authentication\Actions\ResetPasswordAction;
use App\Containers\UserSection\Authentication\Actions\ResetPasswordFromProfileAction;
use App\Containers\UserSection\Authentication\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\UserSection\Authentication\UI\API\Requests\ResetPasswordFromProfileRequest;
use App\Containers\UserSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use App\Containers\UserSection\Authentication\UI\WEB\Requests\ResetPasswordFormRequest;
use App\Containers\UserSection\User\Tasks\FindUserByEmailTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends ApiController
{

    public function resetPasswordForm(ResetPasswordFormRequest $request)
    {
        $token = $request->input('token');
        $email = $request->input('email');

        $user = app(FindUserByEmailTask::class)->run($email);
        $user->setRememberToken(\Hash::make($token));
        $user->save();


        return view('pages.reset-password.index', compact('token', 'email'));
    }

    /**
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     * @throws InvalidResetPasswordTokenException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        app(ResetPasswordAction::class)->run($request);

        return redirect()->intended();
    }

    public function resetPasswordFromProfile(ResetPasswordFromProfileRequest $request): JsonResponse
    {
        app(ResetPasswordFromProfileAction::class)->run($request);

        return $this->noContent();
    }
}
