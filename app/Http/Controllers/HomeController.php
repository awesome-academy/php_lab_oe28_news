<?php

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $newsRepo;
    protected $categoryRepo;

    public function __construct(
        NewsRepositoryInterface $newsRepo,
        CategoryRepositoryInterface $categoryRepo
    ) {
        $this->newsRepo = $newsRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $hotNews = $this->newsRepo->getHotNews();
        $latestNews = $this->newsRepo->getLatestNews();
        $rootCategories = $this->categoryRepo->findByAttributes(['parent_id' => null])->load('news');

        $listCategories = [];

        foreach ($rootCategories as $rootCategory) {
            $collection = collect();

            foreach ($this->categoryRepo->allChildCategoriesWithNews($rootCategory) as $category) {
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
        $searchNews = $this->newsRepo->searchByKeyWordWithStatus($keyWord, [NewsStatus::StatusPublished])->load('category', 'likes');

        return view('search', compact('searchNews', 'keyWord'));
    }

    public function category($slug)
    {
        try {
            $category = $this->categoryRepo->findByAttributesGetOne(['slug' => $slug]);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('home');
        }

        $newsOfCategory = $category->news()
            ->with('likes')
            ->where('status', NewsStatus::StatusPublished)
            ->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));

        $uriCategory = [];

        $temp = $category;
        while ($temp->parent != null) {
            array_push($uriCategory, $temp->parent);
            $temp = $temp->parent;
        }

        return view('category', compact('newsOfCategory', 'category', 'uriCategory'));
    }
}
