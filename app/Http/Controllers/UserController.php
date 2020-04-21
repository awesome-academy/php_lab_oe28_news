<?php

namespace App\Http\Controllers;

use App\Http\Models\News;
use App\Http\Models\User;
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
}
