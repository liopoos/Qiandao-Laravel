@extends('layouts.wide')

@section('content')
    <div class="page-header">
        <h1>我的模板列表
        </h1>
    </div>
    <ul class="list-group">
        <div class="list-group">
            @foreach($list as $item)
                <a href="/template/{{$item['tid']}}" class="list-group-item">
                    <span class="badge">{{$item['used_number']}}</span>
                    <h4 class="list-group-item-heading">{{$item['name']}}</h4>
                    <p class="list-group-item-text">{{$item['description']}}</p>
                </a>
            @endforeach
        </div>
    </ul>
@endsection
