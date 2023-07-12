<?php


namespace App\Ship\Traits\Accessors;


trait TitleAccessor
{
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
