<?php

namespace App\Containers\UserSection\Authorization\Actions;

use App\Containers\UserSection\Authorization\Tasks\AssignRolesToUserTask;
use App\Containers\UserSection\Authorization\Tasks\FindRoleTask;
use App\Containers\UserSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class AssignRolesToUserAction extends ParentAction
{
    /**
     * @param AssignRolesToUserRequest $request
     * @return User
     * @throws NotFoundException
     */
    public function run(AssignRolesToUserRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->user_id);

        $rolesIds = (array)$request->roles_ids;

        $roles = array_map(static function ($roleId) {
            return app(FindRoleTask::class)->run($roleId);
        }, $rolesIds);

        return app(AssignRolesToUserTask::class)->run($user, $roles);
    }
}
