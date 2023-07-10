<?php

namespace App\Containers\UserSection\Authorization\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\UserSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPermissionsAction extends ParentAction
{
    /**
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        return app(GetAllPermissionsTask::class)->run();
    }
}
