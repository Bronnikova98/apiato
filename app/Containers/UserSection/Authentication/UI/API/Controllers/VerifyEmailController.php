<?php

namespace App\Containers\UserSection\Authentication\UI\API\Controllers;

use App\Containers\UserSection\Authentication\Actions\VerifyEmailAction;
use App\Containers\UserSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Throwable;

class VerifyEmailController extends ApiController
{
    /**
     * @param VerifyEmailRequest $request
     * @return JsonResponse
     * @throws NotFoundException
     * @throws Throwable
     */
    public function verifyEmail(VerifyEmailRequest $request): JsonResponse
    {
        app(VerifyEmailAction::class)->run($request);

        return $this->json(null);
    }
}
