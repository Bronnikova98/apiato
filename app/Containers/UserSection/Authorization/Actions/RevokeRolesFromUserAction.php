<?php

namespace App\Containers\UserSection\Authorization\Actions;

use App\Containers\UserSection\Authorization\Tasks\FindRoleTask;
use App\Containers\UserSection\Authorization\Tasks\RevokeRoleFromUserTask;
use App\Containers\UserSection\Authorization\UI\API\Requests\RevokeRolesFromUserRequest;
use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class RevokeRolesFromUserAction extends ParentAction
{
    /**
     * @param RevokeRolesFromUserRequest $request
     * @return User
     * @throws NotFoundException
     */
    public function run(RevokeRolesFromUserRequest $request): User
    {
        $user = app(FindUserByIdTask::class)->run($request->user_id);
        $rolesIds = (array)$request->roles_ids;

        $roles = array_map(static function ($roleId) {
            return app(FindRoleTask::class)->run($roleId);
        }, $rolesIds);

        $this->revokeRoles($user, $roles);

        return $user;
    }

    private function revokeRoles($user, $roles): void
    {
        array_map(static function ($role) use ($user) {
            app(RevokeRoleFromUserTask::class)->run($user, $role);
        }, $roles);
    }
}
