<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Models\PermissionRole;
use App\Models\Manager;
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
        $AllManager_User = Manager::orderBy('created_at', 'desc')->get();
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
        $AllManager_User = Manager::where('permission', $roleName)
                                        ->where('permission', '!=', "0")
                                        ->orderBy('created_at', 'desc')->get();
        $PermissionRole = PermissionRole::where('RoleName', '!=', "0")->get();
        return view('manage.account.PermissionRole', ['roleName'=>$roleName, 'accountData' => $AllManager_User, 'permissionRoleData' => $PermissionRole]);
    }

    // 登入
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => '請填入帳號',
            'password.required' => '請填入密碼',
        ]);
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('manage');
        } else {
            if (Manager::where('username', $credentials['username'])->exists()) {
                return redirect()->back()->withErrors(['password' => '密碼錯誤'])->withInput($request->except('password'));
            } else {
                return redirect()->back()->withErrors(['username' => '帳號不存在'])->withInput($request->except('password'));
            }
        }
    }

    // 登出
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/manage');
    }
}
