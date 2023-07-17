<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Manager_User extends Model implements Authenticatable
{

    use AuthenticableTrait;

    protected $connection = 'mongodb';
    protected $collection = 'manager_user';
    protected $fillable = ['_id','Username', 'Password', 'PermissionLV', 'AccountState'];

    public function createUser($data)
    {
        $this->fill([
            'Username' => $data['username'],
            'Password' => Hash::make($data['password']),
            'PermissionLV' => $data['permissionRole'],
            'AccountState' => $data['accountState']
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
    }

    public function getRole($_id){
        return self::where('_id',$_id)->first()->_id;
    }
}
