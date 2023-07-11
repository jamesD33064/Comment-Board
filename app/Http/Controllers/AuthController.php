<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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
            // 確認登入
            session(['username' => $request->username]);
        
            Log::createLog($request->username, 'Login', 'Success');
            return redirect(route('home'));
        } else {
            Log::createLog($request->username, 'Login', 'Fail');
            return redirect()->back()->withErrors(['error' => 'Login Fail']);
        }        
    }
    
    //登入驗證
    private function customAuthenticate($request)
    {
        $user = User::where('UserName', $request->username)->first();
        return Hash::check($request->password, $user->Password);
    }
    
    // 登出
    public function logout(Request $request)
    {
        $this->clearUserSession();

        Log::createLog($request->username, 'Logout', 'Success');
        return redirect(route('home'));
    }
    
    // 清除登入狀態
    private function clearUserSession()
    {
        Session::forget('username');
    }
}
