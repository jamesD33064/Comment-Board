@extends('layouts.manager-dashboard')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" /><font>
@endsection

@section('content')
<h3>紀錄查詢 / 日誌紀錄</h3>

<table class="table display" id="logTable">
    <thead>
        <tr>
            <th scope="col">創建時間</th>
            <th scope="col">使用者名稱</th>
            <th scope="col">操作</th>
            <th scope="col">詳細內容</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logData as $row)
        <tr id="{{$row['_id']}}">
            <td class="created_at">{{$row['created_at']}}</td>
            <td scope="row" class="user_id">{{$row['user_id']}}</th>
            <td class="action">{{$row['action']}}</td>
            <td class="details">{{$row['details']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('modal')
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
<script type="module" src="{{ asset('js/manage/page_logRecord.js') }}"></script>
@endsection