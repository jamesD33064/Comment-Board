<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;
use App\Models\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth');
    }

    // // 登入
    // public function login(Request $request)
    // {
    //     $user = new User;
    //     if ($user->attemptLogin($request)) {
    //         // 確認登入
    //         Log::createLog($request->username, 'Login', 'Success');
    //         return redirect(route('home'));
    //     }
    //     Log::createLog($request->username, 'Login', 'Fail');
    //     return redirect()->back()->withErrors(['error' => 'Login Fail']);
    // }
    public function login()
    {
        $credentials = request(['username', 'password']);

        // $user = User::where('username', $credentials['username'])->first();
        // // Get the token
        // return $user;
        // if(!$token = auth()->login($user)){
        //     return 'fail';
        // }

        if (! $token = auth()->attempt($credentials)) {
        // if (! $token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return 'success';
        // return $this->respondWithToken($token);
    }

    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => JWTAuth::factory()->getTTL() * 60, // 令牌過期時間（以分鐘為單位）
    //         'user' => auth()->user(), // 如需要，包含已驗證的使用者資訊
    //     ]);
    // }

    // 登出
    public function logout()
    {
        $username = session('username');
        app(User::class)->logout();
        Log::createLog($username, 'Logout', 'Success');
        return redirect(route('home'));
    }
}
