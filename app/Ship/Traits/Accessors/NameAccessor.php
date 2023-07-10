<?php


namespace App\Ship\Traits\Accessors;


trait NameAccessor
{

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

}
