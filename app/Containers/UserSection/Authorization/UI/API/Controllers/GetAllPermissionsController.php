<?php

namespace App\Containers\UserSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\UserSection\Authorization\Actions\GetAllPermissionsAction;
use App\Containers\UserSection\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\UserSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPermissionsController extends ApiController
{
    /**
     * @param GetAllPermissionsRequest $request
     * @return array
     * @throws CoreInternalErrorException
     * @throws InvalidTransformerException
     * @throws RepositoryException
     */
    public function getAllPermissions(GetAllPermissionsRequest $request): array
    {
        $permissions = app(GetAllPermissionsAction::class)->run();

        return $this->transform($permissions, PermissionTransformer::class);
    }
}
