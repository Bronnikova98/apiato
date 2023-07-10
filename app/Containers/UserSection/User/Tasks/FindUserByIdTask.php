<?php

namespace App\Containers\UserSection\User\Tasks;

use App\Containers\UserSection\User\Data\Repositories\UserRepository;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindUserByIdTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param $userId
     * @return User
     * @throws NotFoundException
     */
    public function run($userId): User
    {
        try {
            return $this->repository->find($userId);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
