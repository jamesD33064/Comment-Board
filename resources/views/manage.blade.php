<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @if (!Session::has('username'))
    <!-- login form -->
    @else
    <!-- manage page -->
    
    <!-- @foreach ($commentdata as $CD)
    <div class="message">
        <div class="message-sender"><strong>{{ $CD['UserName'] }}</strong></div>
        <div class="message-content">&nbsp;{{ $CD['CommentContent'] }}</div>
    </div>
    @endforeach -->
    @endif


</body>

</html>