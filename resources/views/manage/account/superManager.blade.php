@extends('layouts.manager-dashboard')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
<font>
    @endsection

    @section('content')
    <h3>帳號管理 / 系統管理員</h3>

    <div class="py-4">
        <button type="button" id="btn_managerRegister" class="btn btn-primary">
            新增帳號
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped text-center table-bordered align-middle table-hover" id="accountTable">
                <thead>
                    <tr>
                        <th scope="col">帳號名稱</th>
                        <th scope="col">帳號權限</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accountData as $row)
                    <tr class="single-manager" id="{{$row['_id']}}">
                        <td class="username_accountTable">{{$row['username']}}</td>
                        <td scope="row" class="Permission_accountTable">{{$row['permission']}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection

    @section('modal')
    <!-- 新增管理員 modal-->
    <div class="modal fade" id="modal_manager_register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增管理員</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Name</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="permission" class="form-label">permissionRole</label>
                        <select class="form-select" aria-label="Default select example" type="text" id="permission" name="permission" required>
                            @foreach($permissionRoleData as $row)
                            <option value="{{$row['RoleName']}}">{{$row['RoleName']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">accountState</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button id="btn_modal_managerRegister" type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 修改管理員密碼 modal -->
    <div class="modal fade" id="modal_manager_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">修改管理員資訊</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">帳號名稱</label>
                        <input type="text" class="form-control" id="modal_manager_update_username" name="username" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">新密碼</label>
                        <input type="password" class="form-control" id="modal_manager_update_password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">確認密碼</label>
                        <input type="password" class="form-control" id="modal_manager_update_passwordAgain" name="passwordAgain" required>
                    </div>
                    <div class="mb-3">
                        <label for="permissionRole" class="form-label">permissionRole</label>
                        <select class="form-select" aria-label="Default select example" type="text" id="modal_manager_update_permissionRole" name="permissionRole" required>
                            @foreach($permissionRoleData as $row)
                            <option value="{{$row['RoleName']}}">{{$row['RoleName']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button id="modal_manager_deleteAccount_confirm" class="btn btn-danger">刪除帳號</button>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="submit" id="modal_manager_update_confirm" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('js')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <script type="module" src="{{ asset('js/manage/page_superManager.js') }}"></script>
    @endsection