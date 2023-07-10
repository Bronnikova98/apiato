<?php

namespace App\Containers\UserSection\Authentication\Tests\Unit;

use App\Containers\UserSection\Authentication\Actions\RegisterUserAction;
use App\Containers\UserSection\Authentication\Notifications\VerifyEmail;
use App\Containers\UserSection\Authentication\Notifications\Welcome;
use App\Containers\UserSection\Authentication\Tests\TestCase;
use App\Containers\UserSection\Authentication\UI\API\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Notification;

/**
 * Class RegisterUserActionTest.
 *
 * @group authentication
 * @group unit
 */
class RegisterUserActionTest extends TestCase
{
    public function testAfterUserRegistration_GivenEmailVerificationEnabled_SendNotification(): void
    {
        if (!config('userSection-authentication.require_email_verification')) {
            $this->markTestSkipped();
        }
        Notification::fake();
        config(['userSection-authentication.require_email_verification', false]);
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'verification_url' => config('userSection-authentication.allowed-verify-email-urls')[0],
        ];

        $request = new RegisterUserRequest($data);
        request()->merge($request->all());
        $user = app(RegisterUserAction::class)->run($request);

        $this->assertModelExists($user);
        $this->assertEquals(strtolower($data['email']), $user->email);
        Notification::assertSentTo($user, Welcome::class);
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function testAfterUserRegistration_GivenEmailVerificationDisabled_ShouldNotSendVerifyEmailNotification(): void
    {
        if (config('userSection-authentication.require_email_verification')) {
            $this->markTestSkipped();
        }
        Notification::fake();
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'verification_url' => config('userSection-authentication.allowed-verify-email-urls')[0],
        ];

        $request = new RegisterUserRequest($data);
        request()->merge($request->all());
        $user = app(RegisterUserAction::class)->run($request);

        $this->assertModelExists($user);
        $this->assertEquals(strtolower($data['email']), $user->email);
        Notification::assertSentTo($user, Welcome::class);
        Notification::assertNotSentTo($user, VerifyEmail::class);
    }
}
