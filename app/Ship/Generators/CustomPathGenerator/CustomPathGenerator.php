<?php

namespace App\Ship\Generators\CustomPathGenerator;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator {

    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media).'/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media).'/conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media).'/responsive-images/';
    }

    private function getBasePath(Media $media)
    {
        $prefix = config('media-library.prefix', '');
        $path = '/images';
        if (!empty($prefix)){
            $path = $prefix;
        }

        $modelTable = (new $media->model_type)->getTable();

       if (!empty($modelTable)) {
           $path .= '/' . $modelTable;
       }

       return $path .'/' .  $media->getKey();
    }
}
