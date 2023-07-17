<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\api\CommentController;

use App\Models\PermissionRole;
use App\Models\Manager_User;
use App\Models\Comment;
use App\Models\Log;

class ManagerAuthController extends Controller
{
    // show page
    public function showManagePage()
    {
        $AllComment = Comment::orderBy('created_at', 'desc')->get();
        $Top10_ActiviteUser = app(Comment::class)->Top10_ActiviteUser();
        $PermissionRole = PermissionRole::where('RoleName', '!=', "0")->get();
        return view('manage.manage', ['commentdata' => $AllComment, 'Top10_ActiviteUser' => $Top10_ActiviteUser, 'permissionRoleData' => $PermissionRole]);
    }
    public function showLogRecordPage()
    {
        $AllLog = Log::orderBy('created_at', 'desc')->get();
        $PermissionRole = PermissionRole::where('RoleName', '!=', "0")->get();
        return view('manage.record.logRecord', ['logData' => $AllLog, 'permissionRoleData' => $PermissionRole]);
    }
    public function showSuperManagerdPage()
    {
        // $AllManager_User = Manager_User::where('PermissionLV', '0')->orderBy('created_at', 'desc')->get();
        $AllManager_User = Manager_User::orderBy('created_at', 'desc')->get();
        $PermissionRole = PermissionRole::where('RoleName', '!=', "0")->get();
        return view('manage.account.superManager', ['accountData' => $AllManager_User, 'permissionRoleData' => $PermissionRole]);
    }
    public function showRoleManagePage()
    {
        $PermissionRole = PermissionRole::where('RoleName', '!=', "0")->get();
        return view('manage.account.roleManage', ['permissionRoleData' => $PermissionRole]);
    }
    public function showPermissionRolePage($roleName)
    {
        $AllManager_User = Manager_User::where('PermissionLV', $roleName)
                                        ->where('PermissionLV', '!=', "0")
                                        ->orderBy('created_at', 'desc')->get();
        $PermissionRole = PermissionRole::where('RoleName', '!=', "0")->get();
        return view('manage.account.PermissionRole', ['roleName'=>$roleName, 'accountData' => $AllManager_User, 'permissionRoleData' => $PermissionRole]);
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
