<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function indexNews()
    {
        $listNews = News::orderBy('created_at', 'desc')->paginate(config('news.paginate'));

        return view('admin.news', compact('listNews'));
    }

    public function showNews($id)
    {
        try {
            $news = News::with('category')->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin.news.index');
        }

        return view('admin.newsdetail', compact('news'));
    }

    public function searchNews(Request $request)
    {
        $keyWord = $request->keyWord;
        $listNews = News::with('category')
            ->where('title', 'like', "%$keyWord%")
            ->orWhere('description', 'like', "%$keyWord%")
            ->orWhere('content', 'like', "%$keyWord%")
            ->paginate(config('news.paginate'));

        return view('admin.news', compact('listNews', 'keyWord'));
    }

    public function category($id)
    {
        try {
            $curCategory = Category::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin.news.index');
        }
        $listNews = $curCategory->news()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));;

        return view('admin.news', compact('listNews', 'curCategory'));
    }
}
