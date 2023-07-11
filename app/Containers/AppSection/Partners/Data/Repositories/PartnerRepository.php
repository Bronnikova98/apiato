<?php

namespace App\Containers\AppSection\Partners\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class PartnerRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
