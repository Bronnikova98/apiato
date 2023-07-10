<?php

namespace App\Containers\UserSection\User\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\UserSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUsersAction extends ParentAction
{
    /**
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        return app(GetAllUsersTask::class)->run();
    }
}
