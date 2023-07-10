<?php

namespace App\Containers\UserSection\User\Actions;

use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\FindUserByIdTask;
use App\Containers\UserSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindUserByIdAction extends ParentAction
{
    /**
     * @param FindUserByIdRequest $request
     * @return User
     * @throws NotFoundException
     */
    public function run(int $userId): User
    {
        return app(FindUserByIdTask::class)->run($userId);
    }
}
