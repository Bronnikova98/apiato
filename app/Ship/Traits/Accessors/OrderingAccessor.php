<?php


namespace App\Ship\Traits\Accessors;


trait OrderingAccessor
{

    public function getOrdering(): ?int
    {
        return $this->ordering;
    }

    public function setOrdering(?int $ordering): void
    {
        $this->ordering = $ordering;
    }

}
