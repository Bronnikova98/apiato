<?php


namespace App\Ship\Traits\Relationships;


use App\Containers\ShopSection\Category\Models\Category;

trait HasCategoryRelation
{
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCategory(): ?Category
    {
        return $this->categoty;
    }

    public function setCategory(?Category $categoty): void
    {
        $this->categoty = $categoty;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): void
    {
        $this->category_id = $category_id;
    }
}
