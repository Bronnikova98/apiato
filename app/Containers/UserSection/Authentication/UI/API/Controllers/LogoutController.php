<?php

namespace App\Containers\UserSection\Authentication\UI\API\Controllers;

use App\Containers\UserSection\Authentication\Actions\ApiLogoutAction;
use App\Containers\UserSection\Authentication\UI\API\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends ApiController
{
    /**
     * @param LogoutRequest $request
     * @return JsonResponse
     */
    public function logout(LogoutRequest $request): JsonResponse
    {
        app(ApiLogoutAction::class)->run($request);

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie(Cookie::forget('refreshToken'));
    }
}
