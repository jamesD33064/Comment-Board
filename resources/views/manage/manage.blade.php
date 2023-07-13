@extends('layouts.manager-dashboard')

@section('content')
<div class="row">
    <div class="col">
        <div class="col-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header d-flex justify-content-between">
                    <div class="card-header-title ">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Comment List
                    </div>
                    <div class="row">
                        <div class="col text-success" id="btn_block_comment" style="display: none;">
                            <span class="pe-auto">Show</span>
                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        </div>
                        <div class="col text-danger" id="btn_none_comment" style="display: none;">
                            <span class="pe-auto">Delete</span>
                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabs-eg-77">
                            <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">ALL Comment</h6>

                            <div class="scroll-area-lg"  style="height: 70dvh;" style="height: 80%;">
                                <div class="scrollbar-container">
                                    <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush" id="comment_list">
                                        @if (Session::has('manager_username'))
                                        @foreach ($commentdata as $CD)
                                        <li class="list-group-item list-group-item-action single-comment" id="{{ $CD['_id'] }}">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">{{ $CD['UserName'] }}
                                                            <small class="widget-subheading">{{ $CD['visible'] }}</small>
                                                        </div>
                                                        <div class="widget-subheading">&nbsp;{{ $CD['CommentContent'] }}</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="font-size-xlg text-muted">
                                                            <small class="widget-subheading">{{ $CD['created_at'] }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="main-card mb-3 card">
            <div class="card-header">Active Users</div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>使用者名稱</th>
                            <th class="text-center">留言數</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Session::has('manager_username'))
                        @foreach ($Top10_ActiviteUser as $user)
                        <tr class="single-activityUser">
                            <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading username_ActiviteTable">{{$user['_id']}}</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{$user['count']}}</td>
                            <td class="text-center">
                                <div class="badge badge-info">Activity</div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modal_UserInfo" tabindex="-1" aria-labelledby="userinfo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 90dvh;">
            <div class="modal-header">
                <h5 class="modal-title" id="userinfo">使用者資訊</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center p-1">
                        <img src="https://i.postimg.cc/bryMmCQB/profile-image.jpg" alt="Profile Image" class="row rounded-circle" style="width:33%;">
                    </div>
                    <div class="col-12 d-flex justify-content-center p-1 text-center">
                        <p id="AccountState_modal_UserInfo" class="bg-light p-2 rounded-3">Activity</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center p-1 text-center">
                        <h3> <strong id="username_modal_UserInfo"></strong> </h3>
                    </div>
                    <div class="col-12 d-flex justify-content-center p-1 text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">visible</th>
                                    <th scope="col">contnet</th>
                                </tr>
                            </thead>
                            <tbody id="AllComment_modal_UserInfo">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">刪除帳號</button>
                <button id="btn_unknow_modal_confirm" type="button" class="btn btn-primary" data-bs-dismiss="modal">確認</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
<script type="module" src="{{ asset('js/manage/page_manage.js') }}"></script>
@endsection