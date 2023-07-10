<?php

namespace App\Containers\UserSection\Authorization\Tests\Unit;

use App\Containers\UserSection\Authorization\Models\Permission;
use App\Containers\UserSection\Authorization\Tests\TestCase;

/**
 * Class PermissionFactoryTest.
 *
 * @group authorization
 * @group unit
 */
class PermissionFactoryTest extends TestCase
{
    public function testCreatePermission(): void
    {
        $permission = Permission::factory()->create();

        $this->assertInstanceOf(Permission::class, $permission);
    }
}
