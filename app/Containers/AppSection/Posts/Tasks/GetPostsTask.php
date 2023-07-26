<?php

namespace App\Containers\AppSection\Posts\Tasks;

use App\Containers\AppSection\Posts\Data\Repositories\PostRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Collection;

class GetPostsTask extends ParentTask
{
    public function __construct(protected PostRepository $repository)
    {
        // ..
    }

    public function run(): Collection
    {
        return $this->repository
            ->where('is_publish', true)
            ->orderBy('created_at', 'desc')->take(4)->get();
    }
}
