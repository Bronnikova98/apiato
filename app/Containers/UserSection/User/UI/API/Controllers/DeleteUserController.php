<?php

namespace App\Containers\UserSection\User\UI\API\Controllers;

use App\Containers\UserSection\User\Actions\DeleteUserAction;
use App\Containers\UserSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteUserController extends ApiController
{
    /**
     * @param DeleteUserRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {
        app(DeleteUserAction::class)->run($request);

        return $this->noContent();
    }
}
