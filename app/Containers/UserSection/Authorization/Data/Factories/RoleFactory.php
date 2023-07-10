<?php

namespace App\Containers\UserSection\Authorization\Data\Factories;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class RoleFactory extends ParentFactory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'guard_name' => 'api',
        ];
    }

    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => config('userSection-authorization.admin_role'),
            ];
        });
    }
}
