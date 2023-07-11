<?php

namespace App\Containers\AppSection\Articles\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class ArticleRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
