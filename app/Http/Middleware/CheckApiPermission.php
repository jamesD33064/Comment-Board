<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PermissionRole;
use Nette\Utils\Json;

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
        $permission = Session::get('PermissionLV');

        if ($permission == "0") {
            return $next($request);
        } else {
            $permissionFlag = 0;

            $permissionRole = PermissionRole::where("RoleName", $permission)->first();
            $permission = json_decode($permissionRole['Permission']);
            $apiPath = $request->getRequestUri();
            $method = $request->method();

            switch ($apiPath) {
                case "/api/log":
                    $permissionFlag = ($method == "GET" && $permission->checkRecord->log->Export); //Export log
                    break;
                case "/api/managerUser":
                    $permissionFlag = ($method == "POST" && $permission->accountManage->admin->C); //Creat Manager
                    break;
                case "/api/permissionRole":
                    $permissionFlag = ($method == "POST" && $permission->accountManage->role->C); //Creat Permission Role
                    break;
            }

            if ($permissionFlag) {
                return $next($request);
            } else {
                return redirect(route('manage'));
            }
        }
    }
}
