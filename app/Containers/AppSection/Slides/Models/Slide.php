<?php

namespace App\Containers\AppSection\Slides\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Slide extends ParentModel
{
    protected $fillable = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Slide';
}
