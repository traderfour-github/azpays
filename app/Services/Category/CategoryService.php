<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository) {
    }

    public function categoryList(array $data)
    {
        return $this->categoryRepository->categoryList($data);
    }

    public function read(string $uuid)
    {
        return $this->categoryRepository->categoryDetail($uuid);
    }

}
