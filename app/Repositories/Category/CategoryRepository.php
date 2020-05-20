<?php

namespace App\Repositories\Category;

use App\Http\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function allChildCategoriesWithNews($category = null)
    {
        $childCategories = $category->children;

        foreach ($childCategories as $child)
        {
            $child->load('news', 'children');
            $childCategories = $childCategories->merge($this->allChildCategoriesWithNews($child));
        }

        return $childCategories;
    }
}
