<?php

namespace App\Containers\ShopSection\Product_fields\Models;

use App\Containers\ShopSection\Category\Models\Category;
use App\Containers\ShopSection\Product_field_values\Models\ProductFieldValue;
use App\Ship\Parents\Models\Model as ParentModel;
use App\Ship\Traits\Accessors\NameAccessor;
use App\Ship\Traits\Relationships\HasCategoryRelation;

/**
 * App\Containers\ShopSection\Product_fields\Models\ProductField
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductFieldValue[] $productFieldsValues
 * @property-read int|null $product_fields_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductField whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductField extends ParentModel
{
    use NameAccessor, HasCategoryRelation;


    protected $fillable = [
        'category_id',
        'name',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'ProductField';

    public function getProductFieldsValues(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->productFieldsValues;
    }

    public function setProductFieldsValues(\Illuminate\Database\Eloquent\Collection|array $productFieldsValues): void
    {
        $this->productFieldsValues = $productFieldsValues;
    }

    public function getProductFieldsValuesCount(): ?int
    {
        return $this->product_fields_values_count;
    }

    public function setProductFieldsValuesCount(?int $product_fields_values_count): void
    {
        $this->product_fields_values_count = $product_fields_values_count;
    }

    public function productFieldsValues(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductFieldValue::class);
    }
}
