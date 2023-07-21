<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Log;

class UserController extends Controller
{
    public function store(Request $request)
    {
        if (!app(User::class)->validate($request->username, $request->password)) {
            $user = new User();
            $user->createUser($request);
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
    public function update(Request $request, $username)
    {
        $oldPW = $request->input('oldPW');
        $newPW = $request->input('newPW');

        $user = User::where('Username', $username)->first();

        if (app(User::class)->validate($username, $oldPW)) {
            $user->Password = Hash::make($newPW);
            $user->save();

            Log::createLog($username, 'Update Password', 'Success');
            return redirect(route('home'));
        }

        Log::createLog($username, 'Update Password', 'Fail');
        return '原密碼錯誤';
    }

    public function destroy($username)
    {
        $user = User::where('Username', $username)->first();

        if ($user) {
            $user->delete();

            Log::createLog($username, 'Delete Account', 'Success');
            return response()->json(['message' => 'Resource deleted successfully']);
        } else {
            Log::createLog($username, 'Delete Account', 'Fail');
            return response()->json(['message' => 'Resource deleted Fail']);
        }
    }
}
