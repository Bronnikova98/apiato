<?php

namespace App\Containers\UserSection\Authorization\Data\Seeders;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\Tasks\CreateRoleTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationRolesSeeder_2 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        if (Role::count() === 0) {
            // Default Roles for every Guard ----------------------------------------------------------------
            foreach (array_keys(config('auth.guards')) as $guardName) {
                app(CreateRoleTask::class)->run(config('userSection-authorization.admin_role'), 'Administrator', 'Administrator Role', $guardName);
                app(CreateRoleTask::class)->run(config('userSection-authorization.developer_role'), 'Developer', 'Developer Role', $guardName);
            }
        }
    }
}
