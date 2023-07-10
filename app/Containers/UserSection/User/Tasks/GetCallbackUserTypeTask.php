<?php

namespace App\Containers\UserSection\User\Tasks;

use App\Containers\CallbackSection\Callback\Data\Enums\CallbackUserTypesEnum;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetCallbackUserTypeTask extends ParentTask
{

    /**
     * @param User|null $user
     * @return int|null
     */
    public function run(?User $user): ?int
    {
        $callbackUserTypeId = null;
        if ($user?->isStudent()) {
            $callbackUserTypeId = CallbackUserTypesEnum::LIST_STUDENT;
        }
        if ($user?->isTeacher()) {
            $callbackUserTypeId = CallbackUserTypesEnum::LIST_TEACHER;
        }

        return $callbackUserTypeId;
    }
}
