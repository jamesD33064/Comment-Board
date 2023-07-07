<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    @if (!Session::has('manager_username'))
    <link href="{{ asset('css/page_manage.css') }}" rel="stylesheet">
    <!-- login form -->
    <div class="container">
        <div class="card">
            <form action="{{route('manage_login')}}" method="post">
                @csrf
                <input type="text" placeholder="Username" name="UserName">
                <input type="password" placeholder="Password" name="Password">
                <div class="buttons">
                    <button type="submit" class="login-button">Login</button>
                </div>
            </form>
        </div>
    </div>
    @else
    <!-- manage page -->

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
                                        {{Session::get('manager_username')}}
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
                            <li class="app-sidebar__heading">
                                <form action="{{route('manage_logout')}}" method="post">
                                    @csrf
                                    <!-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> -->
                                    <button class="btn btn-primary" type="submit">
                                        logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="row">
                        <div class="col">
                            <div class="col-12">
                                <div class="mb-3 card">
                                    <div class="card-header-tab card-header-tab-animation card-header d-flex justify-content-between">
                                        <div class="card-header-title ">
                                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                                            Comment List
                                        </div>
                                        <div class="card-header-title text-danger" id="btn_del_comment" style="display: none;">
                                            Delete
                                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
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
                                                                            <div class="widget-heading">{{ $CD['UserName'] }}</div>
                                                                            <div class="widget-subheading">&nbsp;{{ $CD['CommentContent'] }}</div>
                                                                        </div>
                                                                        <div class="widget-content-right">
                                                                            <div class="font-size-xlg text-muted">
                                                                                <small class="widget-subheading">{{ $CD['TimeStamp'] }}</small>
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
                                                <th>Name</th>
                                                <th class="text-center">City</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-muted">#1</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">unknow</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">Taiwan</td>
                                                <td class="text-center">
                                                    <div class="badge badge-info">Activity</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
    <script type="module" src="{{ asset('js/page_manage.js') }}"></script>
    @endif


</body>

</html>