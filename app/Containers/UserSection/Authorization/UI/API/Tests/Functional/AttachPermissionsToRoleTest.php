<?php

namespace App\Containers\UserSection\Authorization\UI\API\Tests\Functional;

use App\Containers\UserSection\Authorization\Models\Permission;
use App\Containers\UserSection\Authorization\Models\Role;
use App\Containers\UserSection\Authorization\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class AttachPermissionsToRoleTest.
 *
 * @group authorization
 * @group api
 */
class AttachPermissionsToRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/permissions/attach';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testAttachSinglePermissionToRole(): void
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => $permission->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.object', 'Role')
                    ->where('data.id', $role->getHashedKey())
                    ->has('data.permissions.data', 1)
                    ->where('data.permissions.data.0.object', 'Permission')
                    ->where('data.permissions.data.0.id', $permission->getHashedKey())
                    ->etc()
        );
    }

    public function testAttachMultiplePermissionsToRole(): void
    {
        $role = Role::factory()->create();
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data')
                ->where('data.object', 'Role')
                ->where('data.id', $role->getHashedKey())
                ->has('data.permissions.data', 2)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permissionA->getHashedKey())
                ->where('data.permissions.data.1.id', $permissionB->getHashedKey())
                ->etc()
        );
    }

    public function testAttachNonExistingPermissionToRole(): void
    {
        $role = Role::factory()->create();
        $invalidId = 7777;
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => Hashids::encode($invalidId),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(404);
    }

    public function testAttachPermissionToNonExistingRole(): void
    {
        $permission = Permission::factory()->create();
        $invalidId = 7777;
        $data = [
            'role_id' => Hashids::encode($invalidId),
            'permissions_ids' => $permission->getHashedKey(),
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(404);
    }
}
