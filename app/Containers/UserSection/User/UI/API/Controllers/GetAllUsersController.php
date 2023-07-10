<?php

namespace App\Containers\UserSection\User\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\UserSection\User\Actions\GetAllUsersAction;
use App\Containers\UserSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\UserSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUsersController extends ApiController
{
    /**
     * @param GetAllUsersRequest $request
     * @return array
     * @throws CoreInternalErrorException
     * @throws InvalidTransformerException
     * @throws RepositoryException
     */
    public function getAllUsers(GetAllUsersRequest $request): array
    {
        $users = app(GetAllUsersAction::class)->run();

        return $this->transform($users, UserTransformer::class);
    }
}
