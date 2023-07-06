<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/page_manage.css') }}" rel="stylesheet">

</head>

<body>

    @if (!Session::has('manager_username'))
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
    <form action="{{route('manage_logout')}}" method="post">
        @csrf
        <!-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> -->
        <button class="btn btn-primary" type="submit">
            logout
        </button>
    </form>
    @endif


</body>

</html>