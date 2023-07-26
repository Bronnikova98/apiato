<?php

namespace App\Containers\AppSection\Partners\Tasks;

use App\Containers\AppSection\Partners\Data\Repositories\PartnerRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Database\Eloquent\Collection;

class GetPartnersTask extends ParentTask
{
    public function __construct(protected PartnerRepository $repository)
    {
        // ..
    }

    public function run(): Collection
    {
        return $this->repository->where('is_publish', true)->get();
    }
}
