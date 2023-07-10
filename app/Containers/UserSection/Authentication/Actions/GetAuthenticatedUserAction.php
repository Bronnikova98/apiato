<?php

namespace App\Containers\UserSection\Authentication\Actions;

use App\Containers\UserSection\Authentication\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\Authenticatable;

class GetAuthenticatedUserAction extends ParentAction
{
    /**
     * @param GetAuthenticatedUserRequest $request
     * @return Authenticatable
     */
    public function run(GetAuthenticatedUserRequest $request): Authenticatable
    {
        return $request->user();
    }
}
