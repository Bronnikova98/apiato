<?php


namespace App\Ship\Traits\Accessors;


trait ShortDescriptionAccessor
{
    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): void
    {
        $this->short_description = $short_description;
    }
}
