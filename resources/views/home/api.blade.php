@extends('layouts.narrow')
@section('title','API')
@section('content')
    <div class="page-header">
        <h1>API</h1>
    </div>
    <h4>签到(Beta)提供了一些简单的API接口用来脱离当前糟糕的View视图环境。</h4>
    <p>⚠️ 所有的API接口需要使用<code>GET</code>方法携带Access_Token参数，当你第一次登录时，会自动生成一个有效期为10年的Access_Token，所以你不必考虑一段时间内是否会过期，你可以在「<a href="/dashboard" target="_blank">仪表盘</a>」中找到它。请妥善保管好Access_Token，因为它是认证你身份的唯一方式。</p>
    <p>例如：<code>requestUrl/user?access_token=XXX</code></p>
    <h3 id="user">用户信息</h3>
    <p>用于获取用户信息。</p>
    <p>请求方式: <code>GET</code></p>
    <p>请求地址: <code>/api/user</code></p>
    <h3 id="template">模板列表</h3>
    <p>用于获取用户创建的模板。</p>
    <p>请求方式: <code>GET</code></p>
    <p>请求地址: <code>/template/list</code></p>
    <h3 id="task">任务列表</h3>
    <p>用于获取用户创建的任务。</p>
    <p>请求方式: <code>GET</code></p>
    <p>请求地址: <code>/task/list</code></p>
    <h3 id="log">任务日志</h3>
    <p>用于获取任务的日志，当{任务id}为空时，将获取用户下所有的任务日志。</p>
    <p>请求方式: <code>GET</code></p>
    <p>请求参数: </p>
    <pre>page: 分页数</pre>
    <p>请求地址 :<code>/log/{任务id}</code></p>
    <h3 id="do">执行任务</h3>
    <p>用户执行某个任务，当{任务id}为空时，将执行用户下所有的任务。</p>
    <p>请求方式: <code>POST</code></p>
    <p>请求地址 :<code>/do/{任务id}</code></p>

@endsection
@section('sidebar')
    <ul class="hidden-xs hidden-sm">
        <li>
            <a href="#user">用户信息</a>
        </li>
        <li>
            <a href="#template">模板列表</a>
        </li>
        <li>
            <a href="#list">任务列表</a>
        </li>
        <li>
            <a href="#log">任务日志</a>
        </li>
        <li>
            <a href="#do">执行任务</a>
        </li>
    </ul>
@endsection