<?php

namespace App\Containers\UserSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\Authentication\Classes\LoginCustomAttribute;
use App\Containers\UserSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\UserSection\Authentication\Tasks\LoginTask;
use App\Containers\UserSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class WebLoginAction extends ParentAction
{
    /**
     * @param LoginRequest $request
     * @return User|Authenticatable|null
     * @throws LoginFailedException
     * @throws IncorrectIdException
     */
    public function run(LoginRequest $request): User|Authenticatable|null
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'remember_me' => false,
        ]);

        list($username, $loginAttribute) = LoginCustomAttribute::extract($sanitizedData);

        $loggedIn = app(LoginTask::class)->run(
            $username,
            $sanitizedData['password'],
            $loginAttribute,
            $sanitizedData['remember_me']
        );

        if (!$loggedIn) {
            throw new LoginFailedException('Invalid Login Credentials.');
        }

        return Auth::user();
    }
}
