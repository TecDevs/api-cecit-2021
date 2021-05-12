<?php

namespace App\Models;

class CategoryModel
{
    public int $categoryId;
    public string $category;

    public function __construct(array $categoryParams)
    {
        $this->categoryId = $categoryParams['id_category'] ?? 0;
        $this->category = $categoryParams['category'] ?? '';
    }
}
