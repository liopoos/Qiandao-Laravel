@extends('layouts.narrow')
@section('title','文档')
@section('content')
    <div class="page-header">
        <h1>签到(Beta)
            <small>Ver {{config('app.version')}}</small>
        </h1>
    </div>
    <h3 id="what">这是什么</h3>
    <p>签到(Beta)是一个可以进行多个站点签到的开源程序，由PHP强力驱动，使用Laravel(5.8)框架。</p>
    <h3 id="how">如何使用</h3>
    <p>⚠️ 这不是一个即开即用的程序，可能需要以下基础：</p>
    <ul>
        <li>了解使用Charles进行抓包方式</li>
        <li>了解HTTP协议和请求方式</li>
        <li>了解JSON</li>
        <li>了解Cookie、UA等一些基本的请求Header和请求Body体</li>
        <li>能够忍受炒鸡简单的界面和不怎么有逻辑性的操作</li>
    </ul>
    <p>没关系，签到(Beta)提供了一些基本的模板，可以直接使用。</p>
    <h3 id="template">模板</h3>
    <p>模板提供了一个请求套件，每个用户都可以创建自己的模板，一些公共模板将会展示在「模板列表」中。其实这些模板的结构很简单，主要有以下构成：</p>
    <ul>
        <li><strong>请求地址</strong> - 声明该条请求的请求地址</li>
        <li><strong>请求方式</strong> - 声明该条请求的请求方式（GET/POST/PUT等）</li>
        <li><strong>请求Header</strong> - 很多请求需要携带自己的请求头部，大多是需要注意Cookie、Refer等</li>
        <li><strong>请求Query / GET</strong> - GET方式携带的字段</li>
        <li><strong>请求POST</strong> - POST方式携带的字段</li>
        <li><strong>响应字段格式</strong> - 响应字段的格式，目前支持JSON格式</li>
        <li><strong>响应字段</strong> - 请求后返回的响应字段，可以多个字段，需要指明各个字段的关系</li>
        <li><strong>响应关系</strong> - 响应的字段之间的关系，支持与、或关系</li>
    </ul>
    <p>这里有一个详细的模板，可以根据这个模板了解模板的构成👉<a href="/template/10" target="_blank">网易云音乐桌面端签到</a></p>
    <h3 id="creat">如何创建模板</h3>
    <p>
        创建模板时，需要导出Charles的HAR文件，然后粘贴在「HAR文件」输入框中，之后，分别填写需要替换的Header（一般为Cookie）和Query/GET以及POST字段，若没有，请保留输入框中的「[]」，然后还需要添加响应的字段。</p>
    <p><strong>响应字段</strong>用来确认请求URL时返回的信息是否成功，在创建模板时请确认该条请求一定会返回<code>JSON</code>格式的数据，否则系统会解析失败。</p>
    <p>比如一条请求的响应为：</p>
    <pre>
{
  "code":200,
  "msg":"签到成功"
}</pre>
    <p>你已经看到，当code为200的时候表示签到成功，则你可以填写 <code>{"code":200}</code>。</p>
    <p>但是如果code为100的时候也表示签到成功（比如重复签到），你也可以填写两种code的情况：<code>[{"code":200},{"code":100}]</code>。填写完响应后，你需要指明两个code的关系，目前支持与、或的关系。从而确定是「所有条件都必须满足」还是「只满足一个条件」即可。
    </p>
    <p>⚠️ 除了模板名称和描述，所有的字段都需要<code>JSON</code>格式的数据，否则将提交失败。</p>
    <p>⚠️ 如果一条响应是非JSON格式（HTML）或者不需要验证响应，可以在<strong>响应关系</strong>选择「所有的条件都<font color="red">不需要</font>满足」，这时系统将会认为所有的响应都是成功的。</p>
    <h3 id="task">任务</h3>
    <p>选择一个模板，然后可以创建该模板的任务。系统会在每天的凌晨1点钟和下午13点钟进行所有任务的签到，你可以在「仪表盘」中查看所有的任务和模板，同时，「日志」页面会显示所有任务的执行情况。</p>
    <p>除了「日志」，「消息」页面提供了你的日常操作。</p>
    <h3 id="extend">扩展性</h3>
    <p>签到(Beta)使用Laravel框架，你可以创建数据库并部署程序到自己的服务器。</p>
    <p><strong>创建任务调度</strong></p>
    <p>目前签到(Beta)提供了两种任务调度的方法：</p>
    <ol>
        <li>使用云监控（阿里云监控）请求<code>/do</code>。</li>
        <li>使用Crontab任务调度，可以参考Laravel<a href="https://learnku.com/docs/laravel/5.8/scheduling/3924#96da65" target="_blank">官方文档</a>。</li>
    </ol>
    <h3 id="safe">安全性</h3>
    <p>签到(Beta)的工作原理为模拟登录，而Cookie或Session是大多数网页的认证方式，所以当你提交Cookie时，服务器提供者会获取你账号一定的权限，所以如果你不放心提交的数据是否会被滥用，可以<code>clone</code>仓库，并部署在自己的服务器中。<a
                href="https://learnku.com/docs/laravel/5.8/deployment/3884" target="_blank">Laravel文档</a>提供了Apache或Nginx的部署方式。</p>
@endsection
@section('sidebar')
    <ul class="hidden-xs hidden-sm">
        <li>
            <a href="#what">这是什么</a>
        </li>
        <li>
            <a href="#how">如何使用</a>
        </li>
        <li>
            <a href="#template">模板</a>
        </li>
        <li>
            <a href="#creat">如何创建模板</a>
        </li>
        <li>
            <a href="#task">任务</a>
        </li>
        <li>
            <a href="#extend">扩展性</a>
        </li>
        <li>
            <a href="#safe">安全性</a>
        </li>
    </ul>
@endsection