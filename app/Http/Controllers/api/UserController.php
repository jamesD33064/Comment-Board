<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Log;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::where('UserName', $request->username)->first();

        if (!$user) {
            $user = new User;
            $user->UserName = $request->username;
            $user->Password = $request->password;
            $user->save();
        
            Log::createLog($request->username, 'Register New User', 'Success');
        } else {
            Log::createLog($request->username, 'Register New User', 'Fail');
        }
        
        return redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oldPW = $request->input('oldPW');
        $newPW = $request->input('newPW');
        
        $user = User::where('UserName', $id)->first();
        
        if ($user && $user->Password == $oldPW) {
            $user->Password = $newPW;
            $user->save();
        
            Log::createLog($user->UserName, 'Update Password', 'Success');
            return redirect(route('home'));
        }
        
        Log::createLog($user ? $user->UserName : $id, 'Update Password', 'Fail');
        return '原密碼錯誤';
    }

    public function destroy($username)
    {
        $user = User::where('UserName', $username)->first();

        if ($user) {
            $user->delete();
        
            Log::createLog($user->UserName, 'Delete Account', 'Success');
            return response()->json(['message' => 'Resource deleted successfully']);
        } else {
            Log::createLog($username, 'Delete Account', 'Fail');
            return response()->json(['message' => 'Resource deleted Fail']);
        }        
    }
}
