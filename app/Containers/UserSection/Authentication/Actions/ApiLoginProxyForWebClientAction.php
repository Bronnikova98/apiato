<?php

namespace App\Containers\UserSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\UserSection\Authentication\Classes\LoginCustomAttribute;
use App\Containers\UserSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\UserSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\UserSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\UserSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class ApiLoginProxyForWebClientAction extends ParentAction
{
    /**
     * @param LoginProxyPasswordGrantRequest $request
     * @return array
     * @throws LoginFailedException
     * @throws IncorrectIdException
     */
    public function run(LoginProxyPasswordGrantRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput(
            [
                ...array_keys(config('userSection-authentication.login.attributes')),
                ...['password'],
            ]
        );

        list($username) = LoginCustomAttribute::extract($sanitizedData);
        $sanitizedData = $this->enrichSanitizedData($username, $sanitizedData);

        $responseContent = app(CallOAuthServerTask::class)->run($sanitizedData, $request->headers->get('accept-language'));
        $refreshCookie = app(MakeRefreshCookieTask::class)->run($responseContent['refresh_token']);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }

    private function enrichSanitizedData(string $username, array $sanitizedData): array
    {
        $sanitizedData['username'] = $username;
        $sanitizedData['client_id'] = config('userSection-authentication.clients.web.id');
        $sanitizedData['client_secret'] = config('userSection-authentication.clients.web.secret');
        $sanitizedData['grant_type'] = 'password';
        $sanitizedData['scope'] = '';

        return $sanitizedData;
    }
}
