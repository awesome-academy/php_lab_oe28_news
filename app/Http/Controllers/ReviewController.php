<?php

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $newsRepo;
    protected $categoryRepo;
    protected $userRepo;

    public function __construct(
        NewsRepositoryInterface $newsRepo,
        CategoryRepositoryInterface $categoryRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->newsRepo = $newsRepo;
        $this->categoryRepo = $categoryRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $listNews = $this->newsRepo->getAllForReview();

        return view('reviewer.review', compact('listNews'));
    }

    public function category($id)
    {
        try {
            $curCategory = $this->categoryRepo->findOrFail($id);
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
        $listNews = $this->newsRepo->searchByKeyWordWithStatus($keyWord, [
            NewsStatus::StatusNew,
            NewsStatus::StatusApproved,
            NewsStatus::StatusRejected,
            NewsStatus::StatusNeedEditMore,
        ]);

        return view('reviewer.review', compact('listNews', 'keyWord'));
    }

    public function editNews($id)
    {
        try {
            $news = $this->newsRepo->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back();
        }

        if ($news->status == NewsStatus::StatusPublished) {
            return redirect()->back();
        } else {
            return view('reviewer.newsdetail', compact('news'));
        }
    }

    public function readNotification($id)
    {
        try {
            $notification = $this->userRepo->getNotification($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back();
        }

        if ($notification->unread()) {
            $notification->markAsRead();
        }

        return redirect($notification->data['link']);
    }
}
