<?php

namespace App\Containers\UserSection\User\UI\API\Transformers;

use App\Containers\UserSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;
use League\Fractal\Resource\Collection;

class UserTransformer extends ParentTransformer
{
    protected array $availableIncludes = [
        'roles',
    ];

    protected array $defaultIncludes = [

    ];

    public function transform(User $user): array
    {
        $response = [
            'object' => $user->getResourceKey(),
            'id' => $user->getHashedKey(),
            'f_name' => $user->f_name,
            'l_name' => $user->l_name,
            'm_name' => $user->m_name,
            'email' => $user->email,
            'phone' => $user->phone,
        ];

        return $this->ifAdmin([
            'real_id' => $user->id,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ], $response);
    }

    public function includeRoles(User $user): Collection
    {
        return $this->collection($user->roles, new RoleTransformer());
    }
}
