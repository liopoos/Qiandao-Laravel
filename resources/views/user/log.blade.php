@extends('layouts.wide')

@section('title',$title.'日志')

@section('content')
    <div class="page-header">
        <h1>🧾 日志
            <small>{{$title}}</small>
        </h1>
    </div>
    <table class="table">
        <tr>
            <th>任务ID</th>
            <th>模板</th>
            <th>上次执行时间</th>
            <th>状态</th>
        </tr>
        @foreach($list as $item)
            <tr>
                <th><a href="/task/{{$item['task_id']}}">{{$item['task_id']}}</a></th>
                <th><a href="/template/{{$item['tid']}}">{{$item['name']}}</a></th>
                <th>{{date('Y-m-d H:i:s',$item['executed_at'])}}</th>
                <th>
                    @if($item['is_success'] == 1)
                        <span class="label">✔️</span>
                    @else
                        <span class="label">❌</span>
                    @endif
                </th>
            </tr>
        @endforeach
    </table>
    <div class="log-nav">{{ $list->links() }}</div>

@endsection
