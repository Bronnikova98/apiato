<?php

namespace App\Containers\AppSection\Partners\Models;

use App\Enums\MediaCollectionEnum;
use App\Enums\MediaConversionEnum;
use App\Ship\Parents\Models\Model as ParentModel;
use App\Ship\Traits\Accessors\IsPublishAccessor;
use App\Ship\Traits\Accessors\NameAccessor;
use App\Ship\Traits\Accessors\OrderingAccessor;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Containers\AppSection\Partners\Models\Partner
 *
 * @property int $id
 * @property string $name
 * @property int|null $ordering
 * @property int $is_publish
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereIsPublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Partner extends ParentModel implements HasMedia
{
    use NameAccessor, OrderingAccessor, IsPublishAccessor, InteractsWithMedia;


    protected $fillable = [
        'name',
        'ordering',
        'is_publish',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'is_publish' => 'boolean',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Partner';

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_LARGE)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(1200)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_PARTNER);
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_SMALL)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(300)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_PARTNER);
    }
}
