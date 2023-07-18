@extends('layouts.manager-dashboard')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
<font>
    @endsection

    @section('content')
    <h3>帳號管理 / 角色管理</h3>

    <div class="py-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_PermissionRole_register">
            新增權限角色
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped text-center table-bordered align-middle table-hover" id="roleTable">
                <thead>
                    <tr>
                        <th scope="col">角色名稱</th>
                        <th scope="col">創建時間</th>
                        <th scope="col">最後編輯時間</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissionRoleData as $row)
                    <tr class="single-permissionRole" id="{{$row['_id']}}">
                        <td class="created_at rolename">{{$row['RoleName']}}</td>
                        <td scope="row" class="user_id permission">{{$row['created_at']}}</th>
                        <td scope="row" class="user_id permission">{{$row['updated_at']}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endsection

    @section('modal')
    <!-- Modal -->
    <div class="modal fade" id="modal_PermissionRole_register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增權限角色</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- <form action="/api/permissionRole" method="post"> -->
                    <div class="mb-3">
                        <label for="newRoleName" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="newRoleName" name="newRoleName" required>
                    </div>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">大項</th>
                                <th scope="col">單頁面</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="rowspan-combine" rowspan="2" style="vertical-align: middle;">
                                    <label><p type="checkbox" id="checkboxAccountManage">&nbsp;&nbsp;帳號管理</p>
                                </td>
                                <td>
                                    <label><p type="checkbox" id="checkboxAccountManage.superManager">&nbsp;&nbsp;系統管理員</p>
                                </td>
                                <td>
                                    <div class="final">
                                        <label><input type="checkbox" id="checkboxAccountManage.superManager.R">&nbsp;&nbsp;檢視</label>
                                        <label><input type="checkbox" id="checkboxAccountManage.superManager.C">&nbsp;&nbsp;新增</label>
                                        <label><input type="checkbox" id="checkboxAccountManage.superManager.U">&nbsp;&nbsp;修改</label>
                                        <label><input type="checkbox" id="checkboxAccountManage.superManager.D">&nbsp;&nbsp;刪除</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><p type="checkbox" id="checkboxAccountManage.roleManager">&nbsp;&nbsp;角色管理</p>
                                </td>
                                <td>
                                    <div class="final">
                                        <label><input type="checkbox" id="checkboxAccountManage.roleManager.R">&nbsp;&nbsp;檢視</label>
                                        <label><input type="checkbox" id="checkboxAccountManage.roleManager.C">&nbsp;&nbsp;新增</label>
                                        <label><input type="checkbox" id="checkboxAccountManage.roleManager.U">&nbsp;&nbsp;修改</label>
                                        <label><input type="checkbox" id="checkboxAccountManage.roleManager.D">&nbsp;&nbsp;刪除</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="rowspan-combine" rowspan="1" style="vertical-align: middle;">
                                    <label><p type="checkbox" id="checkboxCheckRecord">&nbsp;&nbsp;紀錄查詢</p>
                                <td>
                                    <label><p type="checkbox" id="checkboxCheckRecord.logRecord">&nbsp;&nbsp;日誌記錄</p>
                                </td>
                                <td>
                                    <div>
                                        <label><input type="checkbox" id="checkboxCheckRecord.logRecord.R">&nbsp;&nbsp;檢視</label>
                                        <label><input type="checkbox" id="checkboxCheckRecord.logRecord.Export">&nbsp;&nbsp;匯出</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button id="btn_newPermissionRole_modal_confirm" type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <!-- </form> -->
                </div> <!-- modal body -->
            </div>
        </div>
    </div>

    <!-- 修改權限角色 modal -->
    <div class="modal fade" id="modal_permissionRole_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">修改權限角色資訊</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">角色名稱</label>
                        <input type="text" class="form-control" id="modal_permissionRole_update_username" name="username"  disabled readonly>
                    </div>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">大項</th>
                                <th scope="col">單頁面</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="rowspan-combine" rowspan="2" style="vertical-align: middle;">
                                    <label><p type="checkbox" id="modal_checkboxAccountManage">&nbsp;&nbsp;帳號管理</p>
                                </td>
                                <td>
                                    <label><p type="checkbox" id="checkboxAccountManage.superManager">&nbsp;&nbsp;系統管理員</p>
                                </td>
                                <td>
                                    <div class="final">
                                        <label><input type="checkbox" id="modal_checkboxAccountManage.superManager.R">&nbsp;&nbsp;檢視</label>
                                        <label><input type="checkbox" id="modal_checkboxAccountManage.superManager.C">&nbsp;&nbsp;新增</label>
                                        <label><input type="checkbox" id="modal_checkboxAccountManage.superManager.U">&nbsp;&nbsp;修改</label>
                                        <label><input type="checkbox" id="modal_checkboxAccountManage.superManager.D">&nbsp;&nbsp;刪除</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><p type="checkbox" id="modal_checkboxAccountManage.roleManager">&nbsp;&nbsp;角色管理</p>
                                </td>
                                <td>
                                    <div class="final">
                                        <label><input type="checkbox" id="modal_checkboxAccountManage.roleManager.R">&nbsp;&nbsp;檢視</label>
                                        <label><input type="checkbox" id="modal_checkboxAccountManage.roleManager.C">&nbsp;&nbsp;新增</label>
                                        <label><input type="checkbox" id="modal_checkboxAccountManage.roleManager.U">&nbsp;&nbsp;修改</label>
                                        <label><input type="checkbox" id="modal_checkboxAccountManage.roleManager.D">&nbsp;&nbsp;刪除</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="rowspan-combine" rowspan="1" style="vertical-align: middle;">
                                    <label><p type="checkbox" id="modal_checkboxCheckRecord">&nbsp;&nbsp;紀錄查詢</p>
                                <td>
                                    <label><p type="checkbox" id="modal_checkboxCheckRecord.logRecord">&nbsp;&nbsp;日誌記錄</p>
                                </td>
                                <td>
                                    <div>
                                        <label><input type="checkbox" id="modal_checkboxCheckRecord.logRecord.R">&nbsp;&nbsp;檢視</label>
                                        <label><input type="checkbox" id="modal_checkboxCheckRecord.logRecord.Export">&nbsp;&nbsp;匯出</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button id="modal_permissionRole_deleteRole_confirm" class="btn btn-danger">刪除角色</button>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="submit" id="modal_permissionRole_updateRole_confirm" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('js')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <script type="module" src="{{ asset('js/manage/page_roleManage.js') }}"></script>
    @endsection