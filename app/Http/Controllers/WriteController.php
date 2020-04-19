<?php

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Http\Models\Category;
use App\Http\Models\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WriteController extends Controller
{
    public function index()
    {
        $listNews = News::with('category')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));

        return view('writer.mynews', compact('listNews'));
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
            ->where('user_id', Auth::user()->id)
            ->whereIn('status', [
                NewsStatus::StatusNew,
                NewsStatus::StatusApproved,
                NewsStatus::StatusRejected,
                NewsStatus::StatusNeedEditMore,
            ])->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));

        return view('writer.mynews', compact('listNews', 'curCategory'));
    }

    public function searchNews(Request $request)
    {
        $keyWord = $request->keyWord;
        $listNews = News::with('category')
            ->where('user_id', Auth::user()->id)
            ->where(function ($q) use ($keyWord) {
                $q->where('title', 'like', "%$keyWord%")
                    ->orWhere('description', 'like', "%$keyWord%")
                    ->orWhere('content', 'like', "%$keyWord%");
            })
            ->paginate(config('news.paginate'));

        return view('writer.mynews', compact('listNews', 'keyWord'));
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
            return view('writer.newsdetail', compact('news'));
        }
    }

    public function createNews()
    {
        return view('writer.createnews');
    }

    public function photo(Request $request)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileExtension = $file->getClientOriginalExtension();
            if ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png') {
                $name = time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
                while (file_exists('images/news/' . $name)) {
                    $name = time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
                }

                $file->move('images/news', $name);

                return json_encode(['success' => $name]);
            }
        }
    }
}
