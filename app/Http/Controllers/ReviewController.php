<?php

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Http\Models\Category;
use App\Http\Models\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $listNews = News::with('category')
            ->whereIn('status', [
                NewsStatus::StatusNew,
                NewsStatus::StatusApproved,
                NewsStatus::StatusRejected
            ])->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));

        return view('reviewer.review', compact('listNews'));
    }

    public function category($id)
    {
        try {
            $curCategory = Category::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('review.index');
        }
        $listNews = $curCategory->news()
            ->with('category')
            ->whereIn('status', [
                NewsStatus::StatusNew,
                NewsStatus::StatusApproved,
                NewsStatus::StatusRejected,
                NewsStatus::StatusNeedEditMore,
            ])->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));

        return view('reviewer.review', compact('listNews', 'curCategory'));
    }

    public function searchNews(Request $request)
    {
        $keyWord = $request->keyWord;
        $listNews = News::with('category')
            ->where('title', 'like', "%$keyWord%")
            ->orWhere('description', 'like', "%$keyWord%")
            ->orWhere('id', 'like', "%$keyWord%")
            ->orWhere('content', 'like', "%$keyWord%")
            ->paginate(config('news.paginate'));

        return view('reviewer.review', compact('listNews', 'keyWord'));
    }

    public function editNews($id)
    {
        try {
            $news = News::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back();
        }

        if ($news->status == NewsStatus::StatusPublished) {
            return redirect()->back();
        } else {
            return view('reviewer.newsdetail', compact('news'));
        }
    }
}
