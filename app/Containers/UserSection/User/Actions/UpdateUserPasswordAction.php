<?php

namespace App\Containers\UserSection\User\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\UserSection\User\Tasks\UpdateUserTask;
use App\Containers\UserSection\User\UI\API\Requests\UpdateUserPasswordRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateUserPasswordAction extends ParentAction
{
    /**
     * @param UpdateUserPasswordRequest $request
     * @return User
     * @throws IncorrectIdException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(UpdateUserPasswordRequest $request): User
    {
        $sanitizedData = $request->sanitizeInput([
            'new_password',
        ]);

        $user = app(UpdateUserTask::class)->run(['password' => $sanitizedData['new_password']], $request->id);

        $user->notify(new PasswordUpdatedNotification());

        return $user;
    }
}
