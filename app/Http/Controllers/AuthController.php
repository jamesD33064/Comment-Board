<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        if ($this->customAuthenticate($request)) {
            // 确认登录
            session(['username' => $request->username]);
        
            Log::createLog($request->username, 'Login', 'Success');
            return redirect(route('home'));
        } else {
            Log::createLog($request->username, 'Login', 'Fail');
            return redirect()->back()->withErrors(['error' => 'Login Fail']);
        }        
    }

    // 登出
    public function logout(Request $request)
    {
        $this->clearUserSession();

        Log::createLog($request->username, 'Logout', 'Success');
        return redirect(route('home'));
    }

    private function customAuthenticate($request)
    {
        $user = User::where('UserName', $request->username)
                    ->where('Password', $request->password)
                    ->exists();
    
        return $user;
    }
    

    // 清除登入狀態
    private function clearUserSession()
    {
        Session::forget('username');
    }
}
