<?php

namespace App\Containers\UserSection\Authentication\Tests\Unit;

use App\Containers\UserSection\Authentication\Notifications\VerifyEmail;
use App\Containers\UserSection\Authentication\Tasks\SendVerificationEmailTask;
use App\Containers\UserSection\Authentication\Tests\TestCase;
use App\Containers\UserSection\User\Models\User;
use Illuminate\Support\Facades\Notification;

/**
 * Class SendVerificationEmailTaskTest.
 *
 * @group authentication
 * @group unit
 */
class SendVerificationEmailTaskTest extends TestCase
{
    public function testGivenEmailVerificationEnabled_SendVerificationEmail(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->create();
        config(['userSection-authentication.require_email_verification' => true]);

        app(SendVerificationEmailTask::class)->run($unverifiedUser, 'this_doesnt_matter_for_the_test');

        Notification::assertSentTo($unverifiedUser, VerifyEmail::class);
    }

    public function testGivenEmailVerificationDisabled_ShouldNotSendVerificationEmail(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->create();
        config(['userSection-authentication.require_email_verification' => false]);

        app(SendVerificationEmailTask::class)->run($unverifiedUser);

        Notification::assertNotSentTo($unverifiedUser, VerifyEmail::class);
    }
}
