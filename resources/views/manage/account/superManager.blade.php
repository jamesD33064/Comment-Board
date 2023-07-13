@extends('layouts.manager-dashboard')

@section('content')
<h3>帳號管理 / 系統管理員</h3>

<form action="/api/managerUser" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Name</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<div class="card">
    <div class="card-body">
        <table class="table table-striped text-center table-bordered align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">員工編號</th>
                    <th scope="col">姓名</th>
                    <th scope="col">帳號狀態</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>@twitter</td>
                    <td>@twitter</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('modal')
@endsection

@section('js')
@endsection