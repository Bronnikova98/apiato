<?php

namespace App\Containers\AppSection\Partners\Actions;

use App\Containers\AppSection\Partners\Tasks\GetPartnersTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Collection;

class GetPartnersAction extends ParentAction
{
    public function run(): Collection
    {
        return app(GetPartnersTask::class)->run();
    }
}
