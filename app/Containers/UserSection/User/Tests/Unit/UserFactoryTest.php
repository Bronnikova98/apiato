<?php

namespace App\Containers\UserSection\User\Tests\Unit;

use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tests\TestCase;

/**
 * Class UserFactoryTest.
 *
 * @group user
 * @group unit
 */
class UserFactoryTest extends TestCase
{
    public function testCreateUser(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(User::class, $user);
    }

    public function testCreateAdminUser(): void
    {
        $user = User::factory()->admin()->create();

        $this->assertTrue($user->hasRole(config('userSection-authorization.admin_role')));
    }

    public function testCreateUnverifiedUser(): void
    {
        $user = User::factory()->unverified()->create();

        $this->assertNull($user->email_verified_at);
    }
}
