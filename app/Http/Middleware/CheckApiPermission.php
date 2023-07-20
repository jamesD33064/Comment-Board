<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CheckApiPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiPath = $request->getRequestUri();
        $method = $request->method();
        $permission = Auth::user()->permission;
        $permissionFlag = false;


        if (!strstr($apiPath, "/manage/") && !strstr($apiPath, "api")) {
            // switch($apiPath){
            //     case "/api/user":
            //         break;
            // }
            $permissionFlag = true;
        } else {    //管理頁面
            if ($permission == "0") { //超管
                $permissionFlag = true;
            } else { //不是超管
                $permissionRole = PermissionRole::where("RoleName", $permission)->first();
                $permission = json_decode($permissionRole['Permission']);
                switch ($apiPath) {
                    case "/api/log": //Export log
                        $permissionFlag = ($method == "GET" &&
                            $permission->checkRecord->log->Export);
                        break;
                    case "/api/managerUser": //Creat Manager
                        $permissionFlag = ($method == "POST" &&
                            $permission->accountManage->admin->C);
                        break;
                    case (strstr($apiPath, "/api/managerUser") && ($method == "PUT" || $method == "PATCH")): //Update Manager
                        $permissionFlag = $permission->accountManage->admin->U;
                        break;
                    case (strstr($apiPath, "/api/managerUser") && ($method == "DELETE")): //Delete Manager
                        $permissionFlag =  $permission->accountManage->admin->D;
                        break;
                    case "/api/permissionRole": //Creat Permission Role
                        $permissionFlag = ($method == "POST" &&
                            $permission->accountManage->role->C);
                        break;
                    case (strstr($apiPath, "/api/permissionRole") && ($method == "PUT" || $method == "PATCH")): //Delete Permission Role
                        $permissionFlag =  $permission->accountManage->role->U;
                        break;
                    case (strstr($apiPath, "/api/permissionRole") && ($method == "DELETE")): //Delete Permission Role
                        $permissionFlag =  $permission->accountManage->role->D;
                        break;
                }
            }
        }

        if ($permissionFlag) {
            return $next($request);
        } else {
            $response = new Response();
            $response->setContent('no Permission');

            return $response;
        }
    }
}
