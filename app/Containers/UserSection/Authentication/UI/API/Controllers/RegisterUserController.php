<?php

namespace App\Containers\UserSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\LocationSection\Locality\Actions\FirstOrCreateLocalityAction;
use App\Containers\LocationSection\School\Actions\FirstOrCreateSchoolAction;
use App\Containers\UserSection\Authentication\Actions\RegisterStudentAction;
use App\Containers\UserSection\Authentication\Actions\RegisterStudentVkAction;
use App\Containers\UserSection\Authentication\Actions\RegisterTeacherAction;
use App\Containers\UserSection\Authentication\Actions\RegisterTeacherVkAction;
use App\Containers\UserSection\Authentication\Actions\RegisterUserAction;
use App\Containers\UserSection\Authentication\UI\API\Requests\RegisterStudentRequest;
use App\Containers\UserSection\Authentication\UI\API\Requests\RegisterStudentVkRequest;
use App\Containers\UserSection\Authentication\UI\API\Requests\RegisterTeacherRequest;
use App\Containers\UserSection\Authentication\UI\API\Requests\RegisterTeacherVkRequest;
use App\Containers\UserSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\UserSection\Authentication\Values\RegisterStudentValue;
use App\Containers\UserSection\Authentication\Values\RegisterTeacherValue;
use App\Containers\UserSection\Referral\Data\Enums\ReferralsEnum;
use App\Containers\UserSection\Teacher\Data\Repositories\TeacherRepository;
use App\Containers\UserSection\User\Data\Enums\UsersEnum;
use App\Containers\UserSection\User\Tasks\FormatPhoneTask;
use App\Containers\UserSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterUserController extends ApiController
{
    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws \Apiato\Core\Exceptions\IncorrectIdException
     *
     * @deprecated
     */
    public function registerUser(RegisterUserRequest $request): JsonResponse
    {

        $user = app(RegisterUserAction::class)->transactionalRun($request);

        $result = $this->transform($user, UserTransformer::class);
        return response()->json($result);
    }


}
