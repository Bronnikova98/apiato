<?php

namespace App\Containers\UserSection\Authorization\Tests\Unit;

use App\Containers\UserSection\Authorization\Tasks\CreateRoleTask;
use App\Containers\UserSection\Authorization\Tests\TestCase;

/**
 * Class CreateRoleTaskTest.
 *
 * @group authorization
 * @group unit
 */
class CreateRoleTaskTest extends TestCase
{
    public function testCreateRole(): void
    {
        $name = 'MEga_AdmIn';
        $description = 'The One above all';
        $display_name = 'Mega Admin the Almighty';

        $role = app(CreateRoleTask::class)->run($name, $description, $display_name);

        $this->assertEquals(strtolower($name), $role->name);
        $this->assertEquals($description, $role->description);
        $this->assertEquals($display_name, $role->display_name);
        $this->assertEquals('api', $role->guard_name);
    }
}
