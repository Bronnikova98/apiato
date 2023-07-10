<?php

namespace App\Containers\UserSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\UserSection\Authentication\Actions\GetAuthenticatedUserAction;
use App\Containers\UserSection\Authentication\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\UserSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAuthenticatedUserController extends ApiController
{
    /**
     * @param GetAuthenticatedUserRequest $request
     * @return array
     * @throws InvalidTransformerException
     */
    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request): array
    {
        $user = app(GetAuthenticatedUserAction::class)->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
