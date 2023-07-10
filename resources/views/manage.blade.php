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

                            <div class="scroll-area-lg">
                                <div class="scrollbar-container">
                                    <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush" id="comment_list">

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
                        @foreach ($Top10_ActiviteUser as $user => $count)
                        <tr>
                            <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">{{$user}}</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{$count}}</td>
                            <td class="text-center">
                                <div class="badge badge-info">Activity</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection