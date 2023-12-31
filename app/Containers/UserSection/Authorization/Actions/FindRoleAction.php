<?php

namespace App\Containers\UserSection\Authorization\Actions;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\Tasks\FindRoleTask;
use App\Containers\UserSection\Authorization\UI\API\Requests\FindRoleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindRoleAction extends ParentAction
{
    /**
     * @param FindRoleRequest $request
     * @return Role
     * @throws NotFoundException
     */
    public function run(FindRoleRequest $request): Role
    {
        return app(FindRoleTask::class)->run($request->id);
    }
}
