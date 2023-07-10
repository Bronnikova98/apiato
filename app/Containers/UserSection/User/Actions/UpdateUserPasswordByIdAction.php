<?php

namespace App\Containers\UserSection\User\Actions;

use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\UpdateUserTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateUserPasswordByIdAction extends ParentAction
{
    /**
     * @param int $userId
     * @param string $password
     * @return User
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(int $userId, string $password): User
    {
        return app(UpdateUserTask::class)->run(['password' => $password], $userId);
    }
}
