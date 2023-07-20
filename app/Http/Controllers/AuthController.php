<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth');
    }

    // 登入
    public function login(Request $request)
    {
        $user = new User;
        if ($user->attemptLogin($request)) {
            // 確認登入
            Log::createLog($request->username, 'Login', 'Success');
            return redirect(route('home'));
        }
        Log::createLog($request->username, 'Login', 'Fail');
        return redirect()->back()->withErrors(['error' => 'Login Fail']);
    }

    // 登出
    public function logout()
    {
        $username = session('username');
        app(User::class)->logout();
        Log::createLog($username, 'Logout', 'Success');
        return redirect(route('home'));
    }
}
