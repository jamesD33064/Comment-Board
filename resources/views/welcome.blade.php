@extends('layouts.user-dashboard')

@section('content')
<div class="row">
    <div class="col">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <h1 class="card-title">
                                    Messenger
                                    @if (Session::has('username'))
                                    " {{Session::get('username');}} "<!-- 使用者名稱 -->
                                    @else
                                    " unknow "
                                    @endif
                                </h1>
                            </div>
                            <div id="chatMessages" class="overflow-auto" style="max-height: 60dvh;">
                                <!-- 聊天訊息會顯示在這裡 -->
                                @foreach ($commentdata as $CD)
                                <div class="message">
                                    <div class="message-sender"><strong>{{ $CD['UserName'] }}</strong></div>
                                    <div class="message-content">&nbsp;{{ $CD['CommentContent'] }}</div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <!-- 傳送訊息 -->
                                <form action="/api/comment" method="post" id="messageForm">
                                    <div class="input-group">
                                        <input type="hidden" name="UserName" id="UserName" value="{{ Session::has('username') ? Session::get('username') : 'unknow' }}" required><!-- 使用者名稱 -->
                                        <input type="text" class="form-control" id="CommentContent" name="CommentContent" placeholder="Type a message..." required><!-- 訊息內容 -->
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="modal_user_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">身份確認</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                是否使用匿名身份留言？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">前往註冊</button>
                <button id="btn_unknow_modal_confirm" type="button" class="btn btn-primary" data-bs-dismiss="modal">確認</button>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="module" src="{{ asset('js/page_comment.js') }}"></script>
@endsection