<?php

namespace App\Containers\AppSection\Slides\Models;

use App\Containers\AppSection\Sliders\Models\Slider;
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
 * App\Containers\AppSection\Slides\Models\Slide
 *
 * @property int $id
 * @property int $slider_id
 * @property string $name
 * @property string $url
 * @property int|null $ordering
 * @property int $is_publish
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Slider $slider
 * @method static \Illuminate\Database\Eloquent\Builder|Slide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereIsPublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereUrl($value)
 * @mixin \Eloquent
 */
class Slide extends ParentModel implements HasMedia
{
    use NameAccessor, OrderingAccessor, IsPublishAccessor, InteractsWithMedia;


    protected $fillable = [
        'slider_id',
        'name',
        'url',
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
    protected string $resourceKey = 'Slide';

    public function getSliderId(): int
    {
        return $this->slider_id;
    }

    public function setSliderId(int $slider_id): void
    {
        $this->slider_id = $slider_id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function slider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Slider::class, 'slider_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_LARGE)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(1200)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_SLIDE);
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_SMALL)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(300)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_SLIDE);
    }
}
