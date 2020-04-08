<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('user.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = ['username' => $request->username, 'password' => $request->password, 'active' => 1];
        $remember = $request->remember ?? false;
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('indexLogin');
    }
}
