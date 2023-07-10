<?php

namespace App\Containers\UserSection\User\Tasks;

use App\Containers\UserSection\User\Data\Repositories\UserRepository;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class FindUserByPhoneTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param string $phone
     * @return User
     * @throws NotFoundException
     */
    public function run(string $phone): User
    {
        $phone = app(FormatPhoneTask::class)->run($phone);
        $user = $this->repository->findByField('phone', $phone)->first();

        return $user ?? throw new NotFoundException();
    }
}
