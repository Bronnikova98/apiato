<?php

namespace App\Containers\UserSection\User\Tasks;

use App\Containers\UserSection\User\Data\Repositories\UserRepository;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class FindUserByEmailTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param string $email
     * @return User
     * @throws NotFoundException
     */
    public function run(string $email): User
    {
        $user = $this->repository->findByField('email', $email)->first();

        return $user ?? throw new NotFoundException();
    }
}
