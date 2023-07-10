<?php

namespace App\Containers\UserSection\User\Tests\Unit;

use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\DeleteUserTask;
use App\Containers\UserSection\User\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;

/**
 * Class DeleteUserTaskTest.
 *
 * @group user
 * @group unit
 */
class DeleteUserTaskTest extends TestCase
{
    public function testDeleteUser(): void
    {
        $user = User::factory()->create();

        $result = app(DeleteUserTask::class)->run($user->id);

        $this->assertEquals(1, $result);
    }

    public function testDeleteUserWithInvalidId(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 777777;

        app(DeleteUserTask::class)->run($noneExistingId);
    }
}
