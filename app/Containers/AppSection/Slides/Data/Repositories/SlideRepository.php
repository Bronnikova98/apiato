<?php

namespace App\Containers\AppSection\Slides\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class SlideRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
