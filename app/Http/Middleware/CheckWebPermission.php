<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PermissionRole;
use Nette\Utils\Json;

class CheckWebPermission
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
        $urlPath = $request->getRequestUri();
        $method = $request->method();

        if (!strstr($urlPath, "/manage/")) {
            return $next($request);
        } else {    //管理頁面
            $permission = Session::get('PermissionLV');
            $permissionFlag = false;

            if ($permission == "0") { //超管
                $permissionFlag = 1;
            } else {                //其他人
                //取得資訊
                $permission = json_decode(PermissionRole::where("RoleName", $permission)->first()['Permission']);
                $apiPath = $request->getRequestUri();
                $method = $request->method();

                switch ($apiPath) {
                    case "/manage/log":
                            $permissionFlag = $permission->checkRecord->log->R;//Read log
                        break;
                    case "/manage/account/superManager":
                            $permissionFlag = $permission->accountManage->admin->R;//Read superManager
                        break;
                    case "/manage/account/RoleManage":
                            $permissionFlag = $permission->accountManage->role->R;//Read RoleManage
                        break;
                    default:
                        $permissionFlag = true;
                }
            }

            if ($permissionFlag) {
                return $next($request);
            } else {
                return redirect(route('manage'));
            }
        } //管理頁面
    }
}
