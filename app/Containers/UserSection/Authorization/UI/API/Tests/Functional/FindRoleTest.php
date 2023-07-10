<?php

namespace App\Containers\UserSection\Authorization\UI\API\Tests\Functional;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\UI\API\Tests\ApiTestCase;

/**
 * Class FindRoleTest.
 *
 * @group authorization
 * @group api
 */
class FindRoleTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles/{id}';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testFindRoleById(): void
    {
        $roleA = Role::factory()->create();

        $response = $this->injectId($roleA->id)->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($roleA->name, $responseContent->data->name);
    }

    public function testFindNonExistingRole(): void
    {
        $invalidId = 7777;

        $response = $this->injectId($invalidId)->makeCall([]);

        $response->assertStatus(404);
    }
}
