<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
}
