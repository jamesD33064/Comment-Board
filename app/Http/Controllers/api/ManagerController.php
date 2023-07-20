<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Manager;

class ManagerController extends Controller
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
        $data = $request->only(['username', 'password', 'name', 'email', 'status', 'permission']);
        $Manager = new Manager;
        if(Manager::where('username', $data['username'])->exists()){
            return 'username exists';
        }
        $Manager->createUser($data);
        $Manager->save();
        return 'success';
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
    public function update(Request $request, $id)
    {
        switch ($request->action) {
            case "updatePassword":
                return $this->updatePassword($request);
            case "updatePermission":
                return $this->updatePermission($request);
        }
        return 'fail';
    }

    private function updatePassword($request)
    {
        $user = Manager::where("_id", $request->_id)->first();
        $user->password = Hash::make($request->Password);
        $user->save();

        return "update Password Success";
    }

    private function updatePermission($request)
    {
        if ($request->Permission == "0") {
            return false;
        }
        
        $user = Manager::where("_id", $request->_id)->first();
        $user->permission = $request->Permission;
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
        return Manager::destroy($id);
    }
}
