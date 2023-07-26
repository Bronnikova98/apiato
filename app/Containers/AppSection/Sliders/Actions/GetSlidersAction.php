<?php

namespace App\Containers\AppSection\Sliders\Actions;

use App\Containers\AppSection\Sliders\Tasks\GetSlidersTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Collection;

class GetSlidersAction extends ParentAction
{
    public function run(): Collection
    {
        return app(GetSlidersTask::class)->run();
    }
}
