@extends('layouts.manager-dashboard')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
<font>
    @endsection

    @section('content')
    <h3>帳號管理 / 權限：{{$roleName}}</h3>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped text-center table-bordered align-middle" id="accountTable">
                <thead>
                    <tr>
                        <th scope="col">姓名</th>
                        <th scope="col">帳號狀態</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accountData as $row)
                    <tr id="{{$row['_id']}}">
                        <td class="created_at">{{$row['Username']}}</td>
                        <td scope="row" class="user_id">{{$row['AccountState']}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection

    @section('modal')
    <!-- Modal -->
    <div class="modal fade" id="modal_manager_register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增管理員</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/api/managerUser" method="post">
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
                            <label for="permissionRole" class="form-label">permissionRole</label>
                            <select class="form-select" aria-label="Default select example" type="text" id="permissionRole" name="permissionRole" required>
                                @foreach($permissionRoleData as $row)
                                <option value="{{$row['RoleName']}}">{{$row['RoleName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="accountState" class="form-label">accountState</label>
                            <input type="text" class="form-control" id="accountState" name="accountState" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_unknow_modal_confirm" type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('js')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <script type="module" src="{{ asset('js/manage/page_permissionRole.js') }}"></script>
    @endsection