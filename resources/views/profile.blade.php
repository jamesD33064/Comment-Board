@extends('layouts.user-dashboard')

@section('content')
<div class="container py-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">個人資訊</h5>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>姓名：</strong>
                    <span id="profile_username">
                        @if (Session::has('username'))
                        {{Session::get('username');}}<!-- 使用者名稱 -->
                        @endif
                    </span>
                </li>
                <li class="list-group-item">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#ChangePWForm" aria-expanded="false" aria-controls="collapseExample">
                        修改密碼
                    </button>
                    <div class="collapse" id="ChangePWForm">
                        <div class="card card-body">
                            <form action="{{ route('user.update', ['user' => Session::get('username')] )}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="oldPW" class="form-label">舊密碼</label>
                                    <input type="text" class="form-control" id="oldPW" name="oldPW" required>
                                </div>
                                <div class="mb-3">
                                    <label for="newPW" class="form-label">新密碼</label>
                                    <input type="password" class="form-control" id="newPW" name="newPW" required>
                                </div>
                                <button type="submit" class="btn btn-primary">修改確認</button>
                            </form>

                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <button id="btn_delAccount" class="btn btn-primary" >
                        刪除帳號
                    </button>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modal_delAccount_modal_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">刪除帳號</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                真的要刪除帳號嗎？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">取消</button>
                <button id="btn_delAccount_modal_confirm" type="button" class="btn btn-primary" data-bs-dismiss="modal">確認</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="module" src="{{ asset('js/page_profile.js') }}"></script>
@endsection