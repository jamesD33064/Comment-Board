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
    // show page
    public function showManagePage()
    {
        if (session('manager_username')) {    
            $AllComment = Comment::all();
            $Top10_ActiviteUser = app(Comment::class)->Top10_ActiviteUser();
            return view('manage.manage', ['commentdata' => $AllComment, 'Top10_ActiviteUser' => $Top10_ActiviteUser]);
        }
        return view('manage.manage');
    }
    public function showLogRecordPage()
    {
        if (session('manager_username')) {    
            $AllLog = Log::orderBy('created_at', 'desc')->get();
            return view('manage.record.logRecord', ['logData' => $AllLog]);
        }
        return view('manage.record.logRecord');
    }
    public function showSuperManagerdPage()
    {
        if (session('manager_username')) {    
            $AllLog = Log::all();
            return view('manage.account.superManager', ['logData' => $AllLog]);
        }
        return view('manage.account.superManager');
    }
    public function showRoleManagePage()
    {
        if (session('manager_username')) {    
            $AllLog = Log::all();
            return view('manage.account.roleManage', ['logData' => $AllLog]);
        }
        return view('manage.account.roleManage');
    }

    // auth
    public function login(Request $request)
    {
        $ManagerUser = new Manager_User;
        if ($ManagerUser->attemptLogin($request->username, $request->password)) {
            // 確認登入
            Log::createLog($request->username, 'Manager Login', 'Success');
            return redirect()->route('manage');
        }
        Log::createLog($request->username, 'Manager Login', 'Fail');
        return redirect()->back()->withErrors(['error' => 'Login Fail']);
    }

    // 登出
    public function logout()
    {
        Log::createLog(Session::get('manager_username'), 'Manager Logout', 'Success');
        Session::forget('manager_username');
        return redirect(route('manage'));
    }
}
