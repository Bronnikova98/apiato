<?php

namespace App\Containers\UserSection\User\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\UpdateUserTask;
use App\Containers\UserSection\User\UI\API\Requests\UpdateUserRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateUserAction extends ParentAction
{
    /**
     * @param array $sanitizedData
     * @param int $userId
     * @return User
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $sanitizedData, int $userId): User
    {
        return app(UpdateUserTask::class)->run($sanitizedData, $userId);
    }
}
