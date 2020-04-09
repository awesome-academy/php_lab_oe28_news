<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hotNews = News::with('category')
            ->where('status', 1)
            ->where('hot', 1)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        $latestNews = News::with('category')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $rootCategories = Category::with(['allChildCategoriesWithNews', 'news'])
            ->where('parent_id', null)
            ->get();

        $listCategories = [];

        foreach ($rootCategories as $rootCategory) {
            $collection = collect();

            foreach ($rootCategory->allChildCategoriesWithNews as $category) {
                $collection = $collection->concat($category->news->where('status', 1));
            }

            $collection = $collection->merge($rootCategory->news->where('status', 1));
            if (!empty($collection->count())) array_push($listCategories, [$rootCategory, $collection]);
        }

        return view('home', compact('hotNews', 'latestNews', 'listCategories'));
    }
}
