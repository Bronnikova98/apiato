<?php

namespace App\Containers\UserSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\UserSection\Authorization\Actions\DetachPermissionsFromRoleAction;
use App\Containers\UserSection\Authorization\UI\API\Requests\DetachPermissionsFromRoleRequest;
use App\Containers\UserSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class DetachPermissionsFromRoleController extends ApiController
{
    /**
     * @param DetachPermissionsFromRoleRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function detachPermissionFromRole(DetachPermissionsFromRoleRequest $request): array
    {
        $role = app(DetachPermissionsFromRoleAction::class)->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
