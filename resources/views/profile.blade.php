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
                        <form action="/logout" method="post">
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
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>