<?php

namespace App\Containers\UserSection\Authorization\Actions;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\Tasks\CreateRoleTask;
use App\Containers\UserSection\Authorization\UI\API\Requests\CreateRoleRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateRoleAction extends ParentAction
{
    /**
     * @param CreateRoleRequest $request
     * @return Role
     * @throws CreateResourceFailedException
     */
    public function run(CreateRoleRequest $request): Role
    {
        return app(CreateRoleTask::class)->run($request->name, $request->description, $request->display_name);
    }
}
