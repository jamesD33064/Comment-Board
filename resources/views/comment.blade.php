<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>

<body>

    <div class="container py-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="card-title">
                                Messenger
                                @if (Session::has('username'))
                                {{Session::get('username');}}<!-- 使用者名稱 -->
                                @endif
                            </h5>
                        </div>
                        <div id="chatMessages" class="overflow-auto" style="max-height: 400px;">
                            <!-- 聊天訊息會顯示在這裡 -->
                            @foreach ($commentdata as $CD)
                            <div class="message">
                                <div class="message-sender">{{ $CD['UserName'] }}</div>
                                <div class="message-content">{{ $CD['CommentContent'] }}</div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <!-- 傳送訊息 -->
                            <form action="/api/comment" method="post" id="messageForm">
                                <div class="input-group">
                                    <input type="hidden" name="UserName" id="UserName" value="{{ Session::has('username') ? Session::get('username') : '' }}" required><!-- 使用者名稱 -->
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

</body>

</html>