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

    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{Session::get('username')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            @if (Session::has('username'))
                            <li>
                                <a href="{{route('profile')}}">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    個人頁面
                                </a>
                            </li>
                            <li class="app-sidebar__heading">
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <!-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> -->
                                    <button class="btn btn-primary" type="submit">
                                        logout
                                    </button>
                                </form>
                            </li>
                            @else
                            <li>
                                <a href="{{route('login')}}">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    登入 / 註冊
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
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
                </div>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/axios@0.21.1/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('js/page_comment.js') }}"></script>


</body>

</html>