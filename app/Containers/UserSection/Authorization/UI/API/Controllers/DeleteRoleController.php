<?php

namespace App\Containers\UserSection\Authorization\UI\API\Controllers;

use App\Containers\UserSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\UserSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteRoleController extends ApiController
{
    /**
     * @param DeleteRoleRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteRole(DeleteRoleRequest $request): JsonResponse
    {
        app(DeleteRoleAction::class)->run($request);

        return $this->noContent();
    }
}
