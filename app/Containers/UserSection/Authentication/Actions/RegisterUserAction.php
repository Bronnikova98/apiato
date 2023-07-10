<?php

namespace App\Containers\UserSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\Authentication\Notifications\Welcome;
use App\Containers\UserSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\UserSection\Authentication\Tasks\SendVerificationEmailTask;
use App\Containers\UserSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class RegisterUserAction extends ParentAction
{
    /**
     * @param RegisterUserRequest $request
     * @return User
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(RegisterUserRequest $request): User
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'f_name',
            'm_name',
            'l_name',
        ]);

        $user = app(CreateUserByCredentialsTask::class)->run($sanitizedData);

        $user->notify(new Welcome());
        app(SendVerificationEmailTask::class)->run($user, $request->verification_url);

        return $user;
    }
}
