<?php

namespace App\Containers\ShopSection\Category\Tasks;

use App\Containers\ShopSection\Category\Data\Repositories\CategoryRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GetCategoriesTask extends ParentTask
{
    public function __construct(protected CategoryRepository $repository)
    {
        // ..
    }

    public function run(): Collection
    {
        return $this->repository->get();
    }
}
