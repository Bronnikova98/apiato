<?php

namespace App\Containers\UserSection\Authentication\Traits;

use App\Containers\UserSection\User\Models\User;

trait AuthenticationTrait
{
    /**
     * Allows Passport to authenticate users with custom fields.
     * @param $identifier
     * @return User|null
     */
    public function findForPassport($identifier): ?User
    {
        $allowedLoginAttributes = config('userSection-authentication.login.attributes', ['email' => []]);

        $builder = $this;
        foreach (array_keys($allowedLoginAttributes) as $field) {
            $builder = $builder->orWhere($field, $identifier);
        }

        return $builder->first();
    }
}
