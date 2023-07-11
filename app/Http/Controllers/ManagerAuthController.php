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
    public static function showManagePage()
    {
        if (Session::has('manager_username')) {
            $AllComment = Comment::all();
            $Top10_ActiviteUser = app()->call([CommentController::class, 'Top10_ActiviteUser']);

            Log::createLog(Session::get('manager_username'), 'Show Manage Page', 'Success');
            return view('manage', ['commentdata' => $AllComment, 'Top10_ActiviteUser' => $Top10_ActiviteUser]);
        }

        return view('manage');
    }

    public function login(Request $request)
    {
        // 驗證帳號
        if ($this->customAuthenticate($request)) {
            // 確認登入
            Session::put('manager_username', $request->UserName);
            Log::createLog($request->UserName, 'Manager Login', 'Success');
            return redirect()->route('manage');
        }

        Log::createLog($request->UserName, 'Manager Login', 'Fail');
        return redirect()->back()->withErrors(['error' => '登入失敗']);
    }

    // 驗證帳號
    private function customAuthenticate($request)
    {
        $manage_user = Manager_User::where('UserName', $request->UserName)->get();
        if (count($manage_user) && $request->Password == $manage_user[0]['Password']) {
            return true;
        }
        
        return false;
    }

    // 登出
    public function logout(Request $request)
    {
        Log::createLog(Session::get('manager_username'), 'Manager Logout', 'Success');
        Session::forget('manager_username');
        return redirect(route('manage'));
    }
}
