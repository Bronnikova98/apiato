<?php

namespace App\Containers\ShopSection\Product\Models;

use App\Ship\Casts\Penny;
use App\Ship\Parents\Models\Model as ParentModel;

class Product extends ParentModel
{
    protected $fillable = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'price' => Penny::class,

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Product';
}
