<?php

namespace App\Containers\UserSection\Authorization\Actions;

use App\Containers\UserSection\Authorization\Models\Permission;
use App\Containers\UserSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\UserSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindPermissionAction extends ParentAction
{
    /**
     * @param FindPermissionRequest $request
     * @return Permission
     * @throws NotFoundException
     */
    public function run(FindPermissionRequest $request): Permission
    {
        return app(FindPermissionTask::class)->run($request->id);
    }
}
