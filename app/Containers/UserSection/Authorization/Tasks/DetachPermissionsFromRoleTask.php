<?php

namespace App\Containers\UserSection\Authorization\Tasks;

use App\Containers\UserSection\Authorization\Models\Permission;
use App\Containers\UserSection\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task as ParentTask;

class DetachPermissionsFromRoleTask extends ParentTask
{
    /**
     * @param Role $role
     * @param Permission[] $permissions
     * @return Role
     */
    public function run(Role $role, array $permissions): Role
    {
        array_map(static function ($permission) use ($role) {
            $role->revokePermissionTo($permission);
        }, $permissions);

        return $role;
    }
}
