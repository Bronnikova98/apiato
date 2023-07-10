<?php

namespace App\Containers\UserSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\Authentication\Actions\ForgotPasswordAction;
use App\Containers\UserSection\Authentication\UI\API\Requests\ForgotPasswordRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ForgotPasswordController extends ApiController
{
    /**
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     * @throws IncorrectIdException
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        app(ForgotPasswordAction::class)->run($request);

        return $this->noContent();
    }
}
