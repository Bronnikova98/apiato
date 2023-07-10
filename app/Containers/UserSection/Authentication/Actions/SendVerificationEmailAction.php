<?php

namespace App\Containers\UserSection\Authentication\Actions;

use App\Containers\UserSection\Authentication\Tasks\SendVerificationEmailTask;
use App\Containers\UserSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class SendVerificationEmailAction extends ParentAction
{
    /**
     * @param SendVerificationEmailRequest $request
     * @return void
     */
    public function run(SendVerificationEmailRequest $request): void
    {
        app(SendVerificationEmailTask::class)->run($request->user(), $request->verification_url);
    }
}
