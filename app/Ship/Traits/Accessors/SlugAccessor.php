<?php


namespace App\Ship\Traits\Accessors;


trait SlugAccessor
{

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

}
