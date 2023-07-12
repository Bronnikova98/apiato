<?php


namespace App\Ship\Traits\Accessors;


trait IsPublishAccessor
{
    public function getIsPublish(): int
    {
        return $this->is_publish;
    }

    public function setIsPublish(int $is_publish): void
    {
        $this->is_publish = $is_publish;
    }
}
