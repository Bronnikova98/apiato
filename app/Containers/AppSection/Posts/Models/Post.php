<?php

namespace App\Containers\AppSection\Posts\Models;

use App\Enums\MediaCollectionEnum;
use App\Enums\MediaConversionEnum;
use App\Ship\Parents\Models\Model as ParentModel;
use App\Ship\Traits\Accessors\DateAccessor;
use App\Ship\Traits\Accessors\IsPublishAccessor;
use App\Ship\Traits\Accessors\ShortDescriptionAccessor;
use App\Ship\Traits\Accessors\SlugAccessor;
use App\Ship\Traits\Accessors\TextAccessor;
use App\Ship\Traits\Accessors\TitleAccessor;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Containers\AppSection\Posts\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $date
 * @property string $short_description
 * @property string $text
 * @property int $is_publish
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsPublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends ParentModel
{
    use SlugAccessor, IsPublishAccessor, TitleAccessor, ShortDescriptionAccessor, DateAccessor, TextAccessor, InteractsWithMedia;


    protected $fillable = [
        'title',
        'slug',
        'date',
        'short_description',
        'text',
        'is_publish',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'date' => 'datetime',
        'is_publish' => 'boolean',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Post';

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_LARGE)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(1200)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_POST);
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_SMALL)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(300)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_POST);
    }
}
