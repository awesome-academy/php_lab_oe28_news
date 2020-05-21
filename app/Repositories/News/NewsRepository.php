<?php

namespace App\Repositories\News;

use App\Enums\NewsStatus;
use App\Http\Models\News;
use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{

    public function getModel()
    {
        return News::class;
    }

    public function getAllWithPaginate()
    {
        return $this->model->orderBy('created_at', 'desc')->paginate(config('news.paginate'));
    }

    public function searchByKeyWord($keyWord)
    {
        return $this->model->with('category')
            ->where('title', 'like', "%$keyWord%")
            ->orWhere('description', 'like', "%$keyWord%")
            ->orWhere('content', 'like', "%$keyWord%")
            ->paginate(config('news.paginate'));
    }

    public function getHotNews()
    {
        return $this->model->with('category')
            ->where('status', NewsStatus::StatusPublished)
            ->where('hot', config('news.hot.yes'))
            ->orderBy('created_at', 'desc')
            ->take(config('news.hot.take'))
            ->get();
    }

    public function getLatestNews()
    {
        return $this->model->with('category')
            ->where('status', NewsStatus::StatusPublished)
            ->orderBy('created_at', 'desc')
            ->take(config('news.latest.take'))
            ->get();
    }

    public function searchByKeyWordWithStatus($keyWord, $status = [])
    {
        return $this->model->with(['category', 'likes'])
            ->whereIn('status', $status)
            ->where(function ($q) use ($keyWord) {
                $q->where('title', 'like', "%$keyWord%")
                    ->orWhere('description', 'like', "%$keyWord%")
                    ->orWhere('content', 'like', "%$keyWord%");
            })
            ->paginate(config('news.paginate'));
    }

    public function getAllForReview()
    {
        return $this->model->with('category')
            ->whereIn('status', [
                NewsStatus::StatusNew,
                NewsStatus::StatusApproved,
                NewsStatus::StatusRejected
            ])->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));
    }

    public function getAllOfWriter()
    {
        return $this->model->with('category')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(config('news.paginate'));
    }

    public function searchNewsOfUser($keyWord, $userId)
    {
        return $this->model->with('category')
            ->where('user_id', $userId)
            ->where(function ($q) use ($keyWord) {
                $q->where('title', 'like', "%$keyWord%")
                    ->orWhere('description', 'like', "%$keyWord%")
                    ->orWhere('content', 'like', "%$keyWord%");
            })
            ->paginate(config('news.paginate'));
    }

    public function getAllOfCurrentWeek()
    {
        return $this->model->where('created_at', '>=' , Carbon::now()->startOfWeek())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAllNewsOfMonth($month, $year)
    {
        return $this->model->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
    }
}
