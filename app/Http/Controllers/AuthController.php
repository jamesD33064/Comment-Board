<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth');
    }

    // 登入
    public function login(Request $request)
    {
        // 驗證帳號
        if ($this->customAuthenticate($request)) {
            // 確認登入
            Session::put('username', $request->username);
            return redirect(route('home'));
        } else {
            return redirect()->back()->withErrors(['error' => '登入失敗']);
        }
    }

    // 登出
    public function logout(Request $request)
    {
        $this->clearUserSession();
        return redirect(route('home'));
    }

    // 驗證帳號
    private function customAuthenticate($request)
    {
        $user = User::where('UserName', $request->username)
                    ->where('Password', $request->password)
                    ->get();
        if (count($user) == 1) {
            return true;
        }
        return false;
    }

    // 清除登入狀態
    private function clearUserSession()
    {
        Session::forget('manager_username');
        Session::forget('username');
        Session::forget('email');
    }
}
