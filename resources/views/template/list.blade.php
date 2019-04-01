@extends('layouts.wide')
@section('title','模板列表')
@section('content')
    <div class="page-header">
        <h1>模板列表
            <small>公开的模板列表</small>
        </h1>
    </div>
    <h4>这里公开了一些常用的模板列表，点击即可查看详细信息。</h4>
    <ul class="list-group">
        <div class="list-group">
            @foreach($list as $item)
                <a href="/template/{{$item['tid']}}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{$item['name']}}</h4>
                    <p class="list-group-item-text">{{$item['description']}}</p>
                </a>
            @endforeach
        </div>
    </ul>
@endsection
