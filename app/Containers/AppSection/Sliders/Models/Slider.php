<?php

namespace App\Containers\AppSection\Sliders\Models;

use App\Containers\AppSection\Slides\Models\Slide;
use App\Ship\Parents\Models\Model as ParentModel;
use App\Ship\Traits\Accessors\TitleAccessor;

/**
 * App\Containers\AppSection\Sliders\Models\Slider
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slider extends ParentModel
{
    use TitleAccessor;


    protected $fillable = [
        'title',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Slider';

    public function slides(): void
    {
        $this->hasMany(Slide::class);
    }
}
