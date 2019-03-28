@extends('layouts.wide')

@section('title','仪表板')

@section('content')
    <div class="dashboard-item">
        <div class="page-header">
            <h1>任务列表
                <small>共{{count($taskList)}}个有效任务</small>
            </h1>
        </div>
        <table class="table">
            <tr>
                <th>任务ID</th>
                <th>模板</th>
                <th>创建时间</th>
                <th>上次成功执行时间</th>
                <th>成功次数/失败次数</th>
                <th>成功率</th>
                <th>任务日志</th>
            </tr>
            @foreach($taskList as $item)
                <tr>
                    <th><a href="/task/{{$item['task_id']}}">{{$item['task_id']}}</a></th>
                    <th><a href="/template/{{$item['tid']}}">{{$item['name']}}</a></th>
                    <th>{{date('Y-m-d H:i:s',$item['created_at'])}}</th>
                    <th>{{$item['taskLog']['executed_at']}}</th>
                    <th>{{$item['successCount']}}/{{$item['failCount']}}</th>
                    <th>{{number_format($item['successCount'] / $item['failCount'],2)}}</th>
                    <th><a href="/log/{{$item['task_id']}}">日志</a></th>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="dashboard-item">
        <div class="page-header">
            <h1>模板列表
                <small>共{{count($templateList)}}个模板</small>
            </h1>
        </div>
        <table class="table">
            <tr>
                <th>模板ID</th>
                <th>名称</th>
                <th>描述</th>
                <th>创建时间</th>
                <th>使用人数</th>
                <th>是否为公开模板</th>
            </tr>
            @foreach($templateList as $item)
                <tr>
                    <th><a href="/template/{{$item['tid']}}">{{$item['tid']}}</a></th>
                    <th>{{$item['name']}}</th>
                    <th>{{$item['description']}}</th>
                    <th>{{$item['created_at']}}</th>
                    <th>{{$item['used_number']}}</th>
                    <th>{{$item['is_publish']?'是':'否'}}</th>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
