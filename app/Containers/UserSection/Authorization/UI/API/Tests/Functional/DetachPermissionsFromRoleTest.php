<?php

namespace App\Containers\UserSection\Authorization\UI\API\Tests\Functional;

use App\Containers\UserSection\Authorization\Models\Permission;
use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class DetachPermissionsFromRoleTest.
 *
 * @group authorization
 * @group api
 */
class DetachPermissionsFromRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/permissions/detach';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testDetachSinglePermissionFromRole(): void
    {
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $role = Role::factory()->create();
        $role->givePermissionTo([$permissionA, $permissionB]);
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.object', 'Role')
                    ->where('data.id', $role->getHashedKey())
                    ->count('data.permissions.data', 1)
                    ->where('data.permissions.data.0.id', $permissionB->getHashedKey())
                    ->etc()
        );
    }

    public function testDetachMultiplePermissionFromRole(): void
    {
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $permissionC = Permission::factory()->create();
        $role = Role::factory()->create();
        $role->givePermissionTo([$permissionA, $permissionB, $permissionC]);
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionC->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.object', 'Role')
                    ->where('data.id', $role->getHashedKey())
                    ->count('data.permissions.data', 1)
                    ->where('data.permissions.data.0.id', $permissionB->getHashedKey())
                    ->etc()
        );
    }

    public function testDetachPermissionFromNonExistingRole(): void
    {
        $permission = Permission::factory()->create();
        $invalidId = 7777;
        $data = [
            'role_id' => Hashids::encode($invalidId),
            'permissions_ids' => [$permission->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(404);
    }

    public function testDetachNonExistingPermissionFromRole(): void
    {
        $role = Role::factory()->create();
        $invalidId = 7777;
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => [Hashids::encode($invalidId)],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(404);
    }
}
