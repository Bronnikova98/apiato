<?php

namespace App\Containers\UserSection\User\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class SearchByFIOCriteria extends Criteria
{

    private string $search;

    public function __construct(string $search)
    {
        $this->search = $search;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model
            ->orWhere('f_name', 'like', '%' . $this->search . '%')
            ->orWhere('l_name', 'like', '%' . $this->search . '%')
            ->orWhere('m_name', 'like', '%' . $this->search . '%');
    }

}
