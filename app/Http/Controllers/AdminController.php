<?php

namespace App\Http\Controllers;

use App\Mail\ReportMail;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
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

    public function indexNews()
    {
        $listNews = $this->newsRepo->getAllWithPaginate();

        return view('admin.news', compact('listNews'));
    }

    public function showNews($id)
    {
        try {
            $news = $this->newsRepo->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin.news.index');
        }

        return view('admin.newsdetail', compact('news'));
    }

    public function searchNews(Request $request)
    {
        $keyWord = $request->keyWord;
        $listNews = $this->newsRepo->searchByKeyWord($keyWord);

        return view('admin.news', compact('listNews', 'keyWord'));
    }

    public function category($id)
    {
        try {
            $curCategory = $this->categoryRepo->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin.news.index');
        }
        $listNews = $curCategory->news()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));;

        return view('admin.news', compact('listNews', 'curCategory'));
    }

    public function indexCategories()
    {
        $rootCategories = $this->categoryRepo->findByAttributes(['parent_id' => null])->load('children');

        return view('admin.categories', compact('rootCategories'));
    }

    public function editCategory($id)
    {
        try {
            $curCategory = $this->categoryRepo->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin.categories.index');
        }

        $rootCategories = $this->categoryRepo->findByAttributes(['parent_id' => null])->load('children');

        return view('admin.editcategory', compact('curCategory', 'rootCategories'));
    }
}
