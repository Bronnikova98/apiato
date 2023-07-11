<?php

namespace App\Containers\ShopSection\Category\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class CategoryRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
