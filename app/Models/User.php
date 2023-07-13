<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class User extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'user';
    protected $fillable = ['_id', 'Username', 'Password'];

    public function createUser(Request $request)
    {
        $this->fill([
            'Username' => $request->username,
            'Password' => Hash::make($request->password)
        ]);
    }

    //嘗試登入
    public function attemptLogin(Request $request): bool
    {
        $user = self::where('Username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->Password)) {
            // 確認登入
            session(['userId' => $user->_id]);
            session(['username' => $user->Username]);
            session(['isLogin' => true]);

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
        Session::forget('userId');
        Session::forget('username');
        Session::forget('isLogin');
    }

    // 取得使用者ID
    public function getUserId() : String
    {
        return session('userId');
    }
    
    // 取得使用者名稱
    public function getUsername() : String
    {
        return session('username');
    }

    // 取得使用者
    public function getUser()
    {
        if ($this->isLogin()) {
            return self::find($this->getUserId());
        }
        return null;
    }

    // 確認登入狀態
    public function isLogin()
    {   
        if(Session::has('userId')){
            return 'true';
        } else {
            return 'false';
        }
    }

    // 證實帳戶存在
    public function validate($username, $password): bool
    {
        $user = self::where('Username', $username)->first();
        return (
                $user &&
                Hash::check($password, $user->Password)
                );
    }
}
