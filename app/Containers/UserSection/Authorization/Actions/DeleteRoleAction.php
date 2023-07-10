<?php

namespace App\Containers\UserSection\Authorization\Actions;

use App\Containers\UserSection\Authorization\Tasks\DeleteRoleTask;
use App\Containers\UserSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteRoleAction extends ParentAction
{
    /**
     * @param DeleteRoleRequest $request
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteRoleRequest $request): void
    {
        app(DeleteRoleTask::class)->run($request->id);
    }
}
