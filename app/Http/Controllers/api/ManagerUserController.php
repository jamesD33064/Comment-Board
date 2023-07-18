<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Manager_User;
use App\Models\Log;

class ManagerUserController extends Controller
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
        $data = $request->only(['username', 'password', 'permissionRole', 'accountState']);

        if (!app(Manager_User::class)->validate($data['username'], $data['password'])) {
            $Manager_User = new Manager_User;
            $Manager_User->createUser($data);
            $Manager_User->save();

            Log::createLog($request->username, 'Register New Manager', 'Success');
        } else {
            Log::createLog($request->username, 'Register New Manager', 'Fail');
        }
        return redirect(route('manage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        switch ($request->action) {
            case "updatePassword":
                return $this->updatePassword($request, $username);
            case "updatePermission":
                return $this->updatePermission($request, $username);
        }
        return false;
    }

    private function updatePassword($request, $username)
    {
        $user = Manager_User::where("_id", $request->_id)
                            ->where("Username", $username)
                            ->first();

        $user->Password = Hash::make($request->Password);
        $user->save();

        Log::createLog($user->Username, 'Update Password', 'Success');
        return "update Password Success";
    }

    private function updatePermission($request, $username)
    {
        $user = Manager_User::where("_id", $request->_id)
                            ->where("Username", $username)
                            ->first();

        if ($request->Permission == "0") {
         Log::createLog($user->Username, 'Update permission', "want permission to 0");
            return false;
        }

        Log::createLog($user->Username, 'Update permission', 'from '.$user->PermissionLV." to ".$request->Permission);
        $user->PermissionLV = $request->Permission;
        $user->save();

        return "update Permission Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return Manager_User::destroy($id);
    }
}
