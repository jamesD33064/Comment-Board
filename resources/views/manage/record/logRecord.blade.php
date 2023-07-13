@extends('layouts.manager-dashboard')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" /><font>
@endsection

@section('content')
<h3>紀錄查詢 / 日誌紀錄</h3>

<table class="table display" id="logTable">
    <thead>
        <tr>
            <th scope="col">user_id</th>
            <th scope="col">action</th>
            <th scope="col">details</th>
            <th scope="col">created_at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logData as $log)
        <tr id="{{$log['_id']}}">
            <td scope="row" class="user_id">{{$log['user_id']}}</th>
            <td class="action">{{$log['action']}}</td>
            <td class="details">{{$log['details']}}</td>
            <td class="created_at">{{$log['created_at']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('modal')
@endsection

@section('js')
<script type="text/javascript" src="jquery.dataTables.js"></script>
<script type="text/javascript" src="dataTables.search.html.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
<script type="module" src="{{ asset('js/manage/page_logRecord.js') }}"></script>
@endsection