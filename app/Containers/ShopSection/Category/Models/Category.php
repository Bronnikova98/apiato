<?php

namespace App\Containers\ShopSection\Category\Models;

use App\Containers\ShopSection\Product\Models\Product;
use App\Containers\ShopSection\Product_fields\Models\ProductField;
use App\Enums\MediaCollectionEnum;
use App\Enums\MediaConversionEnum;
use App\Ship\Parents\Models\Model as ParentModel;
use App\Ship\Traits\Accessors\NameAccessor;
use App\Ship\Traits\Accessors\OrderingAccessor;
use App\Ship\Traits\Accessors\SlugAccessor;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Containers\ShopSection\Category\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property bool|null $ordering
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductField[] $productFields
 * @property-read int|null $product_fields_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends ParentModel implements HasMedia
{
    use NameAccessor, SlugAccessor, OrderingAccessor, InteractsWithMedia;


    protected $fillable = [
        'name',
        'slug',
        'description',
        'ordering',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'ordering' => 'boolean',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Category';

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getProductFields() : Collection
    {
        return $this->productFields;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function productFields(): HasMany
    {
        return $this->hasMany(ProductField::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_LARGE)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(1200)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_CATEGORY);
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_SMALL)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(300)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_CATEGORY);
    }
}
