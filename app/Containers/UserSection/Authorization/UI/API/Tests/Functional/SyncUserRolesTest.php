<?php

namespace App\Containers\UserSection\Authorization\UI\API\Tests\Functional;

use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\UserSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class SyncUserRolesTest.
 *
 * @group authorization
 * @group api
 */
class SyncUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles/sync';

    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => '',
    ];

    public function testSyncMultipleRolesOnUser(): void
    {
        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();
        $user = User::factory()->create();
        $user->assignRole($role1);
        $data = [
            'roles_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->count('data.roles.data', 2)
                    ->where('data.roles.data.0.id', $data['roles_ids'][0])
                    ->where('data.roles.data.1.id', $data['roles_ids'][1])
                    ->etc()
        );
    }

    public function testSyncRoleOnNonExistingUser(): void
    {
        $role = Role::factory()->create();
        $invalidId = 7777;
        $data = [
            'roles_ids' => [$role->getHashedKey()],
            'user_id' => Hashids::encode($invalidId),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(404);
    }

    public function testSyncNonExistingRoleOnUser(): void
    {
        $user = User::factory()->create();
        $invalidId = 7777;
        $data = [
            'roles_ids' => [Hashids::encode($invalidId)],
            'user_id' => $user->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(404);
    }
}
