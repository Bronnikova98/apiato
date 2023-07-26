<?php

namespace App\Containers\AppSection\Posts\Actions;

use App\Containers\AppSection\Posts\Tasks\GetPostsTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Collection;

class GetPostsAction extends ParentAction
{
    public function run(): Collection
    {
        return app(GetPostsTask::class)->run();
    }
}
