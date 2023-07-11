<?php

namespace App\Containers\UserSection\Authorization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class RoleRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
        'description' => 'like',
    ];

    public function model(): string
    {
        return config('permission.models.role');
    }
}