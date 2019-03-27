@extends('layouts.app')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="template-hd">
        <div class="page-header">
            <h1>{{$name}}<small>{{$desc}}</small></h1>
        </div>
    </div>
    <div class="template-bd">
        <h3>请求地址</h3>
        <ul class="list-group">
            <li class="list-group-item">{{$requestUrl}}<span class="badge">{{$requestMethod}}</span></li>
        </ul>
        <h3>请求Header</h3>
        @component('component.listItem',['data'=>$headers])
        @endcomponent

        <h3>请求Query / GET</h3>
        @component('component.listItem',['data'=>$query])
        @endcomponent

        <h3>请求POST</h3>
        @component('component.listItem',['data'=>$post])
        @endcomponent
    </div>



@endsection
