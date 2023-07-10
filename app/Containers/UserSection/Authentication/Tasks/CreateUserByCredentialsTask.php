<?php

namespace App\Containers\UserSection\Authentication\Tasks;

use App\Containers\UserSection\User\Data\Repositories\UserRepository;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CreateUserByCredentialsTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    )
    {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->repository->create($data);


        return $user;
    }
}
