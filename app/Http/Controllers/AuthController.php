<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;


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
            // Session::put('email', $request->password);
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
        $count = 0;
        foreach(User::getUserBy_username_pw($request->username, $request->password) as $b){$count+=1;}

        if ($count == 1) {
            return true;
        }
        return false;
    }

    // 清除登入狀態
    private function clearUserSession()
    {
        Session::forget('username');
        Session::forget('email');
    }
}
