@extends('layouts.narrow')

@section('title','任务详情')

@section('content')
    <div class="template-hd">
        <div class="page-header">
            <h1>任务ID:{{$task['taskId']}}
                <small> {{$name}}</small>
            </h1>
        </div>
    </div>
    <div class="template-bd">
        <h3>创建时间</h3>
        <ul class="list-group">
            <li class="list-group-item">{{$task['creatTime']}}</li>
        </ul>
        <h3>请求地址</h3>
        <ul class="list-group">
            <li class="list-group-item">{{$requestUrl}}</li>
        </ul>
        <h3>请求方式</h3>
        <li class="list-group-item">
            {{$requestMethod}}
        </li>
        <h3>请求Header</h3>
        @component('component.listTask',['data'=>$headers,'replace'=>$task['replaceContent']['headers']])
        @endcomponent

        <h3>请求Query / GET</h3>
        @component('component.listTask',['data'=>$query,'replace'=>$task['replaceContent']['query']])
        @endcomponent

        <h3>请求POST</h3>
        @component('component.listTask',['data'=>$post,'replace'=>$task['replaceContent']['post']])
        @endcomponent

        <h3>成功响应</h3>
        @foreach ($successResponse as $item)
            <li class="list-group-item">
                <p>
                    <strong>{{$item['name']}}</strong>:
                    {{$item['value']}}
                </p>
            </li>
        @endforeach

        <h3>关系</h3>
        <li class="list-group-item">
            @if($relation == 1)
                所有的条件都需要满足
            @elseif($relation == 2)
                只需要其中一个条件满足
            @else
                所有的条件都不需要满足
            @endif
        </li>
    </div>

@endsection

@section('sidebar')
    <p>⚠️ <font style="color: red">红色</font>的字段表示自定义的字段。</p>
    <p>目前暂不支持修改任务，如果任务错误，可以选择删除后重新添加。</p>
    <a href="/delete/task/{{$task['taskId']}}" class="btn btn-danger btn-block">删除任务</a>
    <a href="/test/{{$task['taskId']}}" class="btn btn-default btn-block">测试任务</a>
@endsection