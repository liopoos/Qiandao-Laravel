@extends('layouts.wide')

@section('title','消息')

@section('content')
    @if(isset($message))
        <p>{{$message}}。</p>
    @else
        <div class="page-header">
            <h1>📨 消息</h1>
        </div>
        <table class="table">
            <tr>
                <th>用户ID</th>
                <th>操作</th>
                <th>执行时间</th>
            </tr>
            @foreach($list as $item)
                <tr>
                    <th>{{auth()->id()}}</th>
                    <th>{{$item['action']}}</th>
                    <th>{{$item['created_at']}}</th>
                </tr>
            @endforeach
        </table>
        <div class="log-nav">{{ $list->links() }}</div>
    @endif
@endsection
