<?php

namespace App\Containers\ShopSection\Product_field_values\Models;

use App\Containers\ShopSection\Product\Models\Product;
use App\Containers\ShopSection\Product_fields\Models\ProductField;
use App\Ship\Parents\Models\Model as ParentModel;

/**
 * App\Containers\ShopSection\Product_field_values\Models\ProductFieldValue
 *
 * @property int $id
 * @property int $product_field_id
 * @property int $product_id
 * @property int $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Product $product
 * @property-read ProductField $productField
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereProductFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereValue($value)
 * @mixin \Eloquent
 */
class ProductFieldValue extends ParentModel
{
    protected $fillable = [
        'product_field_id',
        'product_id',
        'value',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'ProductFieldValue';

    public function getProductFieldId(): int
    {
        return $this->product_field_id;
    }

    public function setProductFieldId(int $product_field_id): void
    {
        $this->product_field_id = $product_field_id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getProductField(): ProductField
    {
        return $this->productField;
    }

    public function setProductField(ProductField $productField): void
    {
        $this->productField = $productField;
    }

    public function productField(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductField::class, 'product_field_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
