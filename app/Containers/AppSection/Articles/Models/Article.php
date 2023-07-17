<?php

namespace App\Containers\AppSection\Articles\Models;

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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Containers\AppSection\Articles\Models\Article
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
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsPublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends ParentModel implements HasMedia
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
    protected string $resourceKey = 'Article';

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_LARGE)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(1200)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_ARTICLE);
        $this
            ->addMediaConversion(MediaConversionEnum::MEDIA_CONVERSION_SIZE_SMALL)
            ->format(Manipulations::FORMAT_WEBP)
            ->width(300)->performOnCollections(MediaCollectionEnum::MEDIA_COLLECTION_ARTICLE);
    }
}
