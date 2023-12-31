<?php

namespace App\Containers\UserSection\User\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\UserSection\User\Actions\FindUserByIdAction;
use App\Containers\UserSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\UserSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindUserByIdController extends ApiController
{
    /**
     * @param FindUserByIdRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findUserById(FindUserByIdRequest $request): array
    {
        $user = app(FindUserByIdAction::class)->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
