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
        <span class="label label-default">{{$requestMethod}}</span>
        <h3>请求Header</h3>
        @component('component.listInput',['data'=>$headers,'prefix'=>'headers'])
        @endcomponent

        <h3>请求Query / GET</h3>
        @component('component.listInput',['data'=>$query,'prefix'=>'query'])
        @endcomponent

        <h3>请求POST</h3>
        @component('component.listInput',['data'=>$post,'prefix'=>'post'])
        @endcomponent

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
@endsection