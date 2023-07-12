<?php


namespace App\Ship\Traits\Accessors;


trait TextAccessor
{
    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
