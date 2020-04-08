<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\Comment;
use App\Http\Models\News;
use App\Http\Models\User;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('user.register');
    }

    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username'=> $request->username,
            'password'=> bcrypt($request->password),
            'active'=> 1,
        ]);

        return redirect()->route('indexLogin')->with(['message' => trans('pages.complete')]);
    }
}
