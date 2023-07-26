<?php

namespace App\Containers\AppSection\Articles\Actions;

use App\Containers\AppSection\Articles\Tasks\GetArticlesTask;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetArticlesAction extends ParentAction
{
    public function run()
    {
        $var = app(GetArticlesTask::class)->run();
    }
}
