<?php

namespace App\Containers\UserSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\UserSection\Authorization\Actions\FindPermissionAction;
use App\Containers\UserSection\Authorization\UI\API\Requests\FindPermissionRequest;
use App\Containers\UserSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindPermissionController extends ApiController
{
    /**
     * @param FindPermissionRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findPermission(FindPermissionRequest $request): array
    {
        $permission = app(FindPermissionAction::class)->run($request);

        return $this->transform($permission, PermissionTransformer::class);
    }
}
