<?php

namespace App\Containers\UserSection\Authorization\Traits;

trait AuthorizationTrait
{
    public function hasAdminRole(): bool
    {
        return $this->hasRole(config('userSection-authorization.admin_role'));
    }
}
