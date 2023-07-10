<?php

namespace App\Containers\UserSection\Authentication\Actions;

use App\Containers\UserSection\Authentication\Exceptions\InvalidEmailVerificationDataException;
use App\Containers\UserSection\Authentication\Notifications\EmailVerified;
use App\Containers\UserSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Containers\UserSection\User\Models\User;
use App\Containers\UserSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Throwable;

class VerifyEmailAction extends ParentAction
{
    /**
     * @param VerifyEmailRequest $request
     * @throws NotFoundException
     * @throws Throwable
     */
    public function run(VerifyEmailRequest $request): void
    {
        $user = app(FindUserByIdTask::class)->run($request->id);

        throw_unless($this->validateData($request, $user), InvalidEmailVerificationDataException::class);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            $user->notify(new EmailVerified());
        }
    }

    /**
     * @param VerifyEmailRequest $request
     * @param User $user
     * @return bool
     */
    private function validateData(VerifyEmailRequest $request, User $user): bool
    {
        return hash_equals((string)$request->hash, sha1($user->getEmailForVerification()));
    }
}
