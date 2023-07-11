<?php

namespace App\Containers\AppSection\Sliders\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class SliderRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
