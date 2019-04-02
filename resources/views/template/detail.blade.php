@extends('layouts.narrow')

@section('title',$name)

@section('content')
    <div class="template-hd">
        <div class="page-header">
            <h1>{{$name}}
                <small>{{$desc}}</small>
            </h1>
        </div>
    </div>
    <div class="template-bd">
        <h3>请求地址</h3>
        <ul class="list-group">
            <li class="list-group-item">{{$requestUrl}}</li>
        </ul>
        <h3>请求方式</h3>
        <li class="list-group-item">
            {{$requestMethod}}
        </li>
        <h3>请求Header</h3>
        @component('component.listItem',['data'=>$headers])
        @endcomponent

        <h3>请求Query / GET</h3>
        @component('component.listItem',['data'=>$query])
        @endcomponent

        <h3>请求POST</h3>
        @component('component.listItem',['data'=>$post])
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
    <p>⚠️ <kbd>Cookie</kbd>等样式字段需要在创建任务时替换。</p>
    @if(auth()->id() == $uid)
        <a href="/delete/template/{{$tid}}" class="btn btn-danger btn-block">删除模板</a>
    @endif
    <a href="/add/{{$tid}}" class="btn btn-default btn-block">创建任务</a>
@endsection