<?php

namespace App\Containers\UserSection\Authorization\Actions;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\UserSection\Authorization\Tasks\FindRoleTask;
use App\Containers\UserSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class SyncPermissionsOnRoleAction extends ParentAction
{
    /**
     * @param SyncPermissionsOnRoleRequest $request
     * @return Role
     * @throws NotFoundException
     */
    public function run(SyncPermissionsOnRoleRequest $request): Role
    {
        $role = app(FindRoleTask::class)->run($request->role_id);

        $permissionsIds = (array)$request->permissions_ids;

        $permissions = array_map(static function ($permissionId) {
            return app(FindPermissionTask::class)->run($permissionId);
        }, $permissionsIds);

        $role->syncPermissions($permissions);

        return $role;
    }
}
