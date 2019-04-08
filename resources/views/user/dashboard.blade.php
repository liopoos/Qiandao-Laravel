@extends('layouts.wide')

@section('title','仪表板')

@section('content')
    <div class="dashboard-item">
        <div class="page-header">
            <h1>⚙️ Access_Token
                <small>用户ID:{{$userInfo['id']}}</small>
            </h1>
            <pre>{{$userInfo['token']}}</pre>
            <p>使用API时，需要携带Access_Token字段进行验证，当前Access_Token将会在{{date('Y年m月d日',$userInfo['expired_at'])}}过期。</p>
        </div>
        <div class="page-header">
            <h1>🧾 任务列表
                <small>共{{count($taskList)}}个有效任务 <a href="do/{{auth()->id()}}">立即执行</a></small>
            </h1>
        </div>
        <table class="table">
            <tr>
                <th>任务ID</th>
                <th>模板</th>
                <th>创建时间</th>
                <th>上次成功执行时间</th>
                <th>成功次数/失败次数</th>
                <th>失败率</th>
                <th>任务日志</th>
            </tr>
            @foreach($taskList as $item)
                <tr>
                    <th><a href="/task/{{$item['task_id']}}">{{$item['task_id']}}</a></th>
                    <th><a href="/template/{{$item['tid']}}">{{$item['name']}}</a></th>
                    <th>{{date('Y-m-d H:i:s',$item['created_at'])}}</th>
                    <th>{{$item['taskLog']['executed_at']}}</th>
                    <th>{{$item['successCount']}}/{{$item['failCount']}}</th>
                    <th>
                        @if($item['failCount']+$item['successCount'] == 0)
                            N/A
                        @else
                            {{number_format($item['failCount'] / ($item['failCount']+$item['successCount']),2)}}
                        @endif
                    </th>
                    <th><a href="/log/{{$item['task_id']}}">日志</a></th>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="dashboard-item">
        <div class="page-header">
            <h1>📑 模板列表
                <small>共{{count($templateList)}}个模板 <a href="/creat">创建模板</a></small>
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
                    <th><a href="/template/{{$item['tid']}}">{{$item['name']}}</a></th>
                    <th>{{$item['description']}}</th>
                    <th>{{$item['created_at']}}</th>
                    <th>{{$item['used_number']}}</th>
                    <th>{{$item['is_publish']?'✔️':'❌'}}</th>
                    <th><a href="/add/{{$item['tid']}}">创建任务</a></th>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
