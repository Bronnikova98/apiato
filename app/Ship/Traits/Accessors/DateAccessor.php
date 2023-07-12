<?php


namespace App\Ship\Traits\Accessors;


trait DateAccessor
{
    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }
}
