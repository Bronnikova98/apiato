<?php

namespace App\Containers\UserSection\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class UserRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'f_name' => 'like',
        'l_name' => 'like',
        'm_name' => 'like',
        'id' => '=',
        'email' => '=',
        'email_verified_at' => '=',
        'created_at' => 'like',
    ];

    public function model(): string
    {
        return config('auth.providers.users.model');
    }
}
