<?php

namespace App\Containers\UserSection\Authorization\Actions;

use App\Containers\UserSection\Authorization\Tasks\FindRoleTask;
use App\Containers\UserSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class SyncUserRolesAction extends ParentAction
{
    /**
     * @param SyncUserRolesRequest $request
     * @return User
     * @throws NotFoundException
     */
    public function run(SyncUserRolesRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->user_id);

        $rolesIds = (array)$request->roles_ids;

        $roles = array_map(static function ($roleId) {
            return app(FindRoleTask::class)->run($roleId);
        }, $rolesIds);

        $user->syncRoles($roles);

        return $user;
    }
}
