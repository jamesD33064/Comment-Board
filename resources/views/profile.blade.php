<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人資訊</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">個人資訊</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>姓名：</strong>

                                @if (Session::has('username'))
                                {{Session::get('username');}}<!-- 使用者名稱 -->
                                @endif
                            </li>
                            <li class="list-group-item">
                                <strong>修改密碼</strong>
                            </li>
                            <li class="list-group-item">
                                <form action="/logout" method="post">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <button type="submit">
                                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">
                                            logout
                                        </h2>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>