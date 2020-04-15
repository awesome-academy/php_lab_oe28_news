<?php

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Http\Models\Category;
use App\Http\Models\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
        $rootCategories = Category::with('news')
            ->where('parent_id', null)
            ->get();

        $listCategories = [];

        foreach ($rootCategories as $rootCategory) {
            $collection = collect();

            foreach ($this->allChildCategoriesWithNews($rootCategory) as $category) {
                $collection = $collection->merge($category->news->where('status', NewsStatus::StatusPublished));
            }

            $collection = $collection->merge($rootCategory->news->where('status', NewsStatus::StatusPublished));
            if (!empty($collection->count())) array_push($listCategories, [$rootCategory, $collection]);
        }

        return view('home', compact('hotNews', 'latestNews', 'listCategories'));
    }

    public function search(Request $request)
    {
        $keyWord = $request->keyWord;
        $searchNews = News::with(['category', 'likes'])
            ->where('title', 'like', "%$keyWord%")
            ->orWhere('description', 'like', "%$keyWord%")
            ->orWhere('content', 'like', "%$keyWord%")
            ->paginate(config('news.paginate'));

        return view('search', compact('searchNews', 'keyWord'));
    }

    public function category($id)
    {
        try {
            $category = Category::with('children')->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('home');
        }

        $newsOfCategory = $category->news()->with('likes')->paginate(config('news.paginate'));

        $uriCategory = [];

        $temp = $category;
        while ($temp->parent != null) {
            array_push($uriCategory, $temp->parent);
            $temp = $temp->parent;
        }

        return view('category', compact('newsOfCategory', 'category', 'uriCategory'));
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
