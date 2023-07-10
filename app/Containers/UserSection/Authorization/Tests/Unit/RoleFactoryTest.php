<?php

namespace App\Containers\UserSection\Authorization\Tests\Unit;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\Tests\TestCase;

/**
 * Class RoleFactoryTest.
 *
 * @group authorization
 * @group unit
 */
class RoleFactoryTest extends TestCase
{
    public function testCreateRole(): void
    {
        $role = Role::factory()->create();

        $this->assertInstanceOf(Role::class, $role);
    }

    public function testCreateAdminRole(): void
    {
        // 'admin' role is seeded into db automatically, so we have to remove it first before we can test creating it
        // using factory
        Role::findByName(config('userSection-authorization.admin_role'))->delete();

        $role = Role::factory()->admin()->create();

        $this->assertEquals(config('userSection-authorization.admin_role'), $role->name);
    }
}
