<?php

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Http\Models\Category;
use App\Http\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $hotNews = News::with('category')
            ->where('status', NewsStatus::StatusPublished)
            ->where('hot', config('news.hot.yes'))
            ->orderBy('created_at', 'desc')
            ->take(config('news.hot.take'))
            ->get();
        $latestNews = News::with('category')
            ->where('status', NewsStatus::StatusPublished)
            ->orderBy('created_at', 'desc')
            ->take(config('news.latest.take'))
            ->get();
        $rootCategories = Category::with(['allChildCategoriesWithNews', 'news'])
            ->where('parent_id', null)
            ->get();

        $listCategories = [];

        foreach ($rootCategories as $rootCategory) {
            $collection = collect();

            foreach ($rootCategory->allChildCategoriesWithNews as $category) {
                $collection = $collection->concat($category->news->where('status', NewsStatus::StatusPublished));
            }

            $collection = $collection->merge($rootCategory->news->where('status', NewsStatus::StatusPublished));
            if (!empty($collection->count())) array_push($listCategories, [$rootCategory, $collection]);
        }

        return view('home', compact('hotNews', 'latestNews', 'listCategories'));
    }
}
