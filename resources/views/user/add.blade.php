@extends('layouts.narrow')

@section('title','新建'.$name.'任务')
@section('content')
    <div class="page-header">
        <h1>新建<strong>{{$name}}</strong>任务</h1>
    </div>

    <form action="/add/{{$tid}}" method="post">
        @csrf
        <h3>请求地址</h3>
        <ul class="list-group">
            <li class="list-group-item">{{$requestUrl}}</li>
        </ul>
        <h3>请求方式</h3>
        <ul class="list-group">
            <li class="list-group-item">{{$requestMethod}}</li>
        </ul>
        <h3>请求Header</h3>
        @component('component.listInput',['data'=>$headers,'prefix'=>'headers'])
        @endcomponent

        <h3>请求Query / GET</h3>
        @component('component.listInput',['data'=>$query,'prefix'=>'query'])
        @endcomponent

        <h3>请求POST</h3>
        @component('component.listInput',['data'=>$post,'prefix'=>'post'])
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

        <div class="template-btn">
            <button type="submit" class="btn btn-default btn-block">提交</button>
        </div>

    </form>
@endsection

@section('sidebar')
    <h5>⚠️ <strong>{{$name}}</strong>中需要替换的字段：</h5>
    <p>Header</p>
    <ul>
        @foreach($headers as $item)
            @if($item['is_replace'])
                <li>{{$item['name']}}</li>
            @endif
        @endforeach
    </ul>
    <p>Query / GET</p>
    <ul>
        @foreach($query as $item)
            @if($item['is_replace'])
                <li>{{$item['name']}}</li>
            @endif
        @endforeach
    </ul>
    <p>Post</p>
    <ul>
        @foreach($post as $item)
            @if($item['is_replace'])
                <li>{{$item['name']}}</li>
            @endif
        @endforeach
    </ul>
    <p>⚠️ 提交不会校验数据格式，可以提交后自行测试。</p>
@endsection