<?php

namespace App\Containers\UserSection\User\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\UserSection\User\Actions\UpdateUserAction;
use App\Containers\UserSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\UserSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateUserController extends ApiController
{
    /**
     * @param UpdateUserRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function updateUser(UpdateUserRequest $request): array
    {
        $user = app(UpdateUserAction::class)->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
