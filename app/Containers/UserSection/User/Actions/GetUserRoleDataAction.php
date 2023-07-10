<?php

namespace App\Containers\UserSection\User\Actions;

use App\Containers\AppSection\App\Values\ProfileValue;
use App\Containers\UserSection\Student\Models\Student;
use App\Containers\UserSection\Teacher\Models\Teacher;
use App\Containers\UserSection\User\Models\User;

class GetUserRoleDataAction
{
    public function run(): ?ProfileValue
    {
        /**
         * @var Teacher|Student $role
         * @var User $user
         */
        $user = \Auth::guard('web')->user();
        $value = null;
        if ($user !== null) {
            $value = ProfileValue::run();

            $value->setUserFName($user->getFirstName());
            $value->setUserLName($user->getLastName());
            $value->setUserMName($user->getMiddleName());
            $value->setEmail($user->getEmail());

            $role = $user->getUserDataRole();

            $type = $role?->getProfileType() ?? null;
            $value->setType($type);

            if ($role !== null) {

                $school = $role->getSchool();
                $value->setSchoolName($school->getFullName());

                $locality = $school->getLocality();
                $value->setLocalityName($locality->getName());

                $region = $locality->getRegion();
                $value->setRegionName($region->getName());

                if ($role instanceof Teacher) {
                    $value->setObject($role->getSubject());
                    $value->setPhone($user->getPhone());
                    $value->setPlace($role->getGlobalPlace());
                    $value->setTeacherStudentsCount($role->getRatingableStudents()->count());
                    $value->setReferralLink($role->getReferralLink());
                    $value->setPoints($role->getRatingFormatted());
                    $value->setReported($user->hasCallback());
                }
                if ($role instanceof Student)
                {
                    $teacher = $role->getTeacher();
                    $value->setTeacherName($teacher?->getUserFullName());
                    $value->setTeacherStudentsCount($role->getTeacher()?->getRatingableStudents()->count() ?? 0);
                    $value->setPoints($role->getTeacher()?->getRatingFormatted() ?? 0);
                    $value->setPlace($role->getTeacher()?->getGlobalPlace() ?? 0);
                }
            }


        }

        return $value;
    }


}
