<?php

namespace App\Containers\AppSection\Sliders\Tasks;

use App\Containers\AppSection\Sliders\Data\Repositories\SliderRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GetSlidersTask extends ParentTask
{
    public function __construct(protected SliderRepository $repository)
    {

    }

    public function run(): Collection
    {
        //вынести запросы в критерии
        return $this->repository
            ->whereHas('slides', function (Builder $query) {
                return $query->where('is_publish', true);
            })
            ->with(['slides' => function(HasMany $query)
            {
                return $query->where('is_publish', true);
            }])->get();
    }
}
