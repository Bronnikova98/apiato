<?php

namespace App\Containers\UserSection\Authorization\Tests\Unit;

use App\Containers\UserSection\Authorization\Models\Permission;
use App\Containers\UserSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\UserSection\Authorization\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;

/**
 * Class FindPermissionTaskTest.
 *
 * @group authorization
 * @group unit
 */
class FindPermissionTaskTest extends TestCase
{
    public function testFindPermissionById(): void
    {
        $permission = Permission::factory()->create();

        $result = app(FindPermissionTask::class)->run($permission->id);

        $this->assertEquals($permission->id, $result->id);
    }

    public function testFindPermissionByName(): void
    {
        $permission = Permission::factory()->create();

        $result = app(FindPermissionTask::class)->run($permission->name);

        $this->assertEquals($permission->id, $result->id);
    }

    public function testFindPermissionWithInvalidId_Throws404(): void
    {
        $this->expectException(NotFoundException::class);

        $invalidId = 7777;

        app(FindPermissionTask::class)->run($invalidId);
    }
}
