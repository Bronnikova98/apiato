<?php

namespace App\Containers\UserSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\UserSection\Authorization\Actions\AttachPermissionsToRoleAction;
use App\Containers\UserSection\Authorization\UI\API\Requests\AttachPermissionsToRoleRequest;
use App\Containers\UserSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class AttachPermissionsToRoleController extends ApiController
{
    /**
     * @param AttachPermissionsToRoleRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function attachPermissionsToRole(AttachPermissionsToRoleRequest $request): array
    {
        $role = app(AttachPermissionsToRoleAction::class)->run($request);

        return $this->transform($role, RoleTransformer::class);
    }
}
