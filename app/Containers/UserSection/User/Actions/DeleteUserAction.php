<?php

namespace App\Containers\UserSection\User\Actions;

use App\Containers\UserSection\User\Tasks\DeleteUserTask;
use App\Containers\UserSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteUserAction extends ParentAction
{
    /**
     * @param DeleteUserRequest $request
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteUserRequest $request): void
    {
        app(DeleteUserTask::class)->run($request->id);
    }
}
