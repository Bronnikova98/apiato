<?php

namespace App\Containers\ShopSection\Product\Models;

use App\Containers\ShopSection\Category\Models\Category;
use App\Containers\ShopSection\Product_field_values\Models\ProductFieldValue;
use App\Enums\MediaCollectionEnum;
use App\Enums\MediaConversionEnum;
use App\Ship\Casts\Penny;
use App\Ship\Parents\Models\Model as ParentModel;
use App\Ship\Traits\Accessors\NameAccessor;
use App\Ship\Traits\Accessors\OrderingAccessor;
use App\Ship\Traits\Accessors\SlugAccessor;
use App\Ship\Traits\Relationships\HasCategoryRelation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Containers\ShopSection\Product\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $category_id
 * @property string|null $description
 * @property int|null $ordering
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property mixed $price
 * @property-read Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductFieldValue[] $productFieldValues
 * @property-read int|null $product_field_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends ParentModel implements HasMedia
{
    use NameAccessor, SlugAccessor, OrderingAccessor, HasCategoryRelation, InteractsWithMedia;


    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'price',
        'description',
        'ordering',

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): mixed
    {
        return $this->price;
    }

    public function setPrice(mixed $price): void
    {
        $this->price = $price;
    }

    public function getProductFieldValues(): Collection
    {
        return $this->productFieldValues;
    }

    public function setProductFieldValues(Collection $productFieldValues): void
    {
        $this->productFieldValues = $productFieldValues;
    }

    public  function productFieldValues(): HasMany
    {
        return $this->hasMany(ProductFieldValue::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_LARGE)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(1200)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_PRODUCT);
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_SMALL)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(300)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_PRODUCT);
    }
}
