<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('UserName', $request->username)->get();
        if (count($user) == 0) {
            $user = new User;
            $user->UserName = $request->username;
            $user->Password = $request->password;
            $user->save();
            Log::createLog($request->username, 'Register New User', 'Success');
            return redirect(route('home'));
        }
        Log::createLog($request->username, 'Register New User', 'Fail');
        return redirect(route('home'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

        $user = User::where('UserName', $id)->get();
        if ($user[0]['Password'] == $oldPW) {
            $user[0]->Password = $newPW;
            $user[0]->save();

            Log::createLog($user[0]['UserName'], 'Update Password', 'Success');
            return redirect(route('home'));
        }

        Log::createLog($user[0]['UserName'], 'Update Password', 'Fail');
        return '原密碼錯誤';
    }

    public function destroy($username)
    {
        $user = User::where('UserName', $username)->get();
        
        if (count($user) == 1) {
            User::destroy($user[0]['_id']);
            // 刪除帳號成功
            
            Log::createLog($user[0]['UserName'], 'Delete Account', 'Success');
            return response()->json(['message' => 'Resource deleted successfully']);
        }
        else{
            Log::createLog($username, 'Delete Account', 'Fail');
            return response()->json(['message' => 'Resource deleted Fail']);;
        }
    }
}
