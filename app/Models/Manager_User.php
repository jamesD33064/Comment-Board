<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Manager_User extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'manager_user';
    protected $fillable = ['_id','Username', 'Password', 'PermissionLV'];

    public function createUser($Username, $Password, $PermissionLV)
    {
        $this->fill([
            'Username' => $Username,
            'Password' => Hash::make($Password),
            'PermissionLV' => $PermissionLV
        ]);
    }

    //嘗試登入
    public function attemptLogin($username, $password): bool
    {
        $ManagerUser = self::where('Username', $username)->first();
        if ($ManagerUser && Hash::check($password, $ManagerUser->Password)) {
            // 確認登入
            session(['managerId' => $ManagerUser->_id]);
            session(['manager_username' => $ManagerUser->Username]);
            session(['PermissionLV' => $ManagerUser->PermissionLV]);
            session(['managerIsLogin' => true]);

            return true;
        }
        return false;
    }

    // 登出
    public function logout()
    {
        $this->clearUserSession();
    }

    // 清除登入狀態
    private function clearUserSession()
    {
        Session::forget('managerId');
        Session::forget('manager_username');
        Session::forget('PermissionLV');
        Session::forget('managerIsLogin');
    }
    
    // 證實帳戶存在
    public function validate($username, $password): bool
    {
        $manage_user = self::where('Username', $username)->first();
        return (
                $manage_user &&
                $password ==  $manage_user->Password
                );

        // $user = self::where('Username', $username)->first();
        // return (
        //         $user &&
        //         Hash::check($password, $user->Password)
        //         );
    }
}
