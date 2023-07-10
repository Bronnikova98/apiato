<?php

namespace App\Containers\UserSection\Authorization\Tasks;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Contracts\Auth\Authenticatable;

class RevokeRoleFromUserTask extends ParentTask
{
    /**
     * @param User $user
     * @param string|int|Role $role
     * @return Authenticatable
     */
    public function run(User $user, string|int|Role $role): Authenticatable
    {
        return $user->removeRole($role);
    }
}
