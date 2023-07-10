<?php

namespace App\Containers\UserSection\Authentication\Tests\Unit;

use App\Containers\UserSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\UserSection\Authentication\Tests\TestCase;
use App\Containers\UserSection\User\Models\User;

/**
 * Class CreatePasswordResetTokenTaskTest.
 *
 * @group authentication
 * @group unit
 */
class CreatePasswordResetTokenTaskTest extends TestCase
{
    public function testCreatePasswordResetTask(): void
    {
        $user = User::factory()->create();

        app(CreatePasswordResetTokenTask::class)->run($user);

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email,
        ]);
    }
}
