<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\UserProfileRequest;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $newsRepo;
    protected $userRepo;
    protected $commentRepo;

    public function __construct(
        NewsRepositoryInterface $newsRepo,
        UserRepositoryInterface $userRepo,
        CommentRepositoryInterface $commentRepo
    ) {
        $this->newsRepo = $newsRepo;
        $this->userRepo = $userRepo;
        $this->commentRepo = $commentRepo;
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(UserProfileRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ];

        $this->userRepo->update(Auth::id(), $data);

        return redirect()->back()->with('success', trans('pages.successful'));
    }


    public function handleLike(Request $request)
    {
        try {
            $news = $this->newsRepo->findByAttributesGetOne(['slug' => $request->slug]);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(trans('pages.error'));
        }

        if ($news->isAuthUserLikedNews()) {
            $this->userRepo->unlikesNews($news);

            return json_encode(['error' => trans('delete')]);
        }
        $this->userRepo->likesNews($news);

        return json_encode(['success' => trans('pages.success')]);
    }

    public function comment(CommentRequest $request, $slug)
    {
        try {
            $news = $this->newsRepo->findByAttributesGetOne(['slug' => $slug]);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(trans('pages.error'));
        }

        $this->commentRepo->create([
            'content' => $request->comment_content,
            'user_id' => Auth::id(),
            'news_id' => $news->id,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
        $data = [
            'id' => $request->id,
            'user_id' => Auth::id(),
        ];

        $comment = $this->commentRepo->findByAttributesGetOne($data);
        if ($comment->children != null) {
            $comment->children()->delete();
        }
        $comment->delete();

        return json_encode(['success' => trans('pages.successful')]);
    }
}
