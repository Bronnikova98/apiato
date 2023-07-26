<?php

namespace App\Containers\ShopSection\Category\Actions;

use App\Containers\ShopSection\Category\Tasks\GetCategoriesTask;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Collection;


class GetCategoriesAction extends ParentAction
{
    public function run(): Collection
    {
        return app(GetCategoriesTask::class)->run();
    }
}
