<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PermissionRole;
use App\Models\Manager_User;
use App\Models\Log;

class PermissionRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $PermissionRole = new PermissionRole;
        
        if($PermissionRole->createRole($request->RoleName, $request->Permission)){
            $PermissionRole->save();
            Log::createLog($request->RoleName, 'New Permission Role', 'Success');
            return true;
        }
        Log::createLog($request->RoleName, 'New Permission Role', 'fail');
        return false;
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
        // return $request->Permission['accountManage']['role']['C'];
        $role = PermissionRole::find($id);
        $role->Permission = $request->Permission;
        $role->save();
        
        return "更新成功";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = PermissionRole::find($id);
        if(!Manager_User::where('PermissionLV',$role->RoleName)->exists()){
            $role->delete();
            return '刪除成功';
        }
        return '有管理者使用這個權限';
    }
}
