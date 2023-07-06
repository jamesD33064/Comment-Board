<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Manager_User;

class ManagerAuthController extends Controller
{
    public function login(Request $request)
    {
        // 驗證帳號
        if ($this->customAuthenticate($request)) {
            // 確認登入
            Session::put('manager_username', $request->UserName);
            return redirect(route('manage'));
        } else {
            return redirect()->back()->withErrors(['error' => '登入失敗']);
        }
    }

    // 驗證帳號
    private function customAuthenticate($request)
    {
        $PW = Manager_User::getUserPWBy_username($request->UserName);
        if ($request->Password == $PW) {
            return true;
        }
        return false;
    }

    // 登出
    public function logout(Request $request)
    {
        Session::forget('manager_username');
        return redirect(route('manage'));
    }
}
