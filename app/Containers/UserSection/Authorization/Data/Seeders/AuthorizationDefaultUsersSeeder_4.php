<?php

namespace App\Containers\UserSection\Authorization\Data\Seeders;

use App\Containers\UserSection\User\Actions\CreateAdminAction;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;
use Throwable;

class AuthorizationDefaultUsersSeeder_4 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     * @throws Throwable
     */
    public function run(): void
    {
        if (User::count() === 0) {
            // Default Users (with their roles) ---------------------------------------------
            $this->createSuperAdmin();
        }
    }

    /**
     * @throws CreateResourceFailedException
     * @throws Throwable
     */
    private function createSuperAdmin(): void
    {
        $userData = [
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'f_name' => 'System',
            'l_name' => 'User',
        ];

        app(CreateAdminAction::class)->run($userData);
    }
}
