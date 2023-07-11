<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\api\CommentController;

use App\Models\Manager_User;
use App\Models\Comment;
use App\Models\Log;

class ManagerAuthController extends Controller
{
    public function showManagePage()
    {
        if (session('manager_username')) {
            $AllComment = Comment::all();
            $Top10_ActiviteUser = app()->call([CommentController::class, 'Top10_ActiviteUser']);

            Log::createLog(Session::get('manager_username'), 'Show Manage Page', 'Success');
            return view('manage', ['commentdata' => $AllComment, 'Top10_ActiviteUser' => $Top10_ActiviteUser]);
        }

        return view('manage');
    }

    public function login(Request $request)
    {
        if ($this->customAuthenticate($request)) {
            // 確認登入
            session(['manager_username' => $request->UserName]);
        
            Log::createLog($request->UserName, 'Manager Login', 'Success');
            return redirect()->route('manage');
        } else {
            Log::createLog($request->UserName, 'Manager Login', 'Fail');
            return redirect()->back()->withErrors(['error' => 'Login Fail']);
        }
        
    }

    // 驗證帳號
    private function customAuthenticate($request)
    {
        $manage_user = Manager_User::where('UserName', $request->UserName)->first();
        if ($manage_user && $request->Password ==  $manage_user->Password) {
            return true;
        }

        return false;
    }

    // 登出
    public function logout()
    {
        Log::createLog(Session::get('manager_username'), 'Manager Logout', 'Success');
        Session::forget('manager_username');
        return redirect(route('manage'));
    }
}
