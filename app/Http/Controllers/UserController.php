<?php

namespace App\Http\Controllers;

use App\Http\Models\Comment;
use App\Http\Models\News;
use App\Http\Models\User;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(UserProfileRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        $user->save();

        return redirect()->back()->with('success', trans('pages.successful'));
    }


    public function handleLike(Request $request)
    {
        $news = News::where('slug', $request->slug)->first();
        if ($news->isAuthUserLikedNews()) {
            $news->likes()->detach(Auth::id());

            return json_encode(['error' => trans('delete')]);
        }
        $news->likes()->attach(Auth::id());

        return json_encode(['success' => trans('pages.success')]);
    }

    public function comment(CommentRequest $request, $slug)
    {
        try {
            $news = News::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(trans('pages.error'));
        }

        Comment::create([
            'content' => $request->comment_content,
            'user_id' => Auth::id(),
            'news_id' => $news->id,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
        $comment = Comment::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        if ($comment->children != null) {
            $comment->children()->delete();
        }
        $comment->delete();

        return json_encode(['success' => trans('pages.successful')]);
    }
}
