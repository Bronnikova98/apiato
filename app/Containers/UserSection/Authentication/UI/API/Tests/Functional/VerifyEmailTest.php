<?php

namespace App\Containers\UserSection\Authentication\UI\API\Tests\Functional;

use App\Containers\UserSection\Authentication\Notifications\EmailVerified;
use App\Containers\UserSection\Authentication\UI\API\Tests\ApiTestCase;
use App\Containers\UserSection\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

/**
 * Class VerifyEmailTest.
 *
 * @group authentication
 * @group api
 */
class VerifyEmailTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/email/verify/{id}/{hash}';

    protected array $access = [
        'roles' => '',
        'permissions' => '',
    ];

    public function testVerifyEmail(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->create();
        $hashedEmail = sha1($unverifiedUser->getEmailForVerification());
        // enable email verification
        config(['userSection-authentication.require_email_verification' => true]);
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            [
                'id' => $unverifiedUser->getHashedKey(),
                'hash' => $hashedEmail,
            ]
        );

        $match = [];
        $expires = $match[preg_match('/expires=(.*?)&/', $url, $match)];
        $signature = $match[preg_match('/signature=(.*)/', $url, $match)];

        $response = $this->injectId($unverifiedUser->id)
            ->injectId($hashedEmail, skipEncoding: true, replace: '{hash}')
            ->endpoint($this->endpoint . "?expires=$expires&signature=$signature")
            ->makeCall();

        $response->assertStatus(200);
        $unverifiedUser->refresh();
        $this->assertTrue($unverifiedUser->hasVerifiedEmail());
        Notification::assertSentTo($unverifiedUser, EmailVerified::class);
    }

    public function testVerifyEmailShouldNotBeAcceptedIfRoutesSignatureIsNotVerified(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->create();
        $hashedEmail = sha1($unverifiedUser->getEmailForVerification());
        // enable email verification
        config(['userSection-authentication.require_email_verification' => true]);
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            [
                'id' => $unverifiedUser->getHashedKey(),
                'hash' => $hashedEmail,
            ]
        );

        $match = [];
        $expires = $match[preg_match('/expires=(.*?)&/', $url, $match)];
        $signature = 'invalid_sig';

        $response = $this->injectId($unverifiedUser->id)
            ->injectId($hashedEmail, skipEncoding: true, replace: '{hash}')
            ->endpoint($this->endpoint . "?expires=$expires&signature=$signature")
            ->makeCall();

        $response->assertStatus(403);
    }
}
