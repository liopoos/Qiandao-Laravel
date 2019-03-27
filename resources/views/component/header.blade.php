<div class="header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">菜单</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
            </div>

            <ul class="nav navbar-nav">
                <li @if (getSidebarActiveIndex('index')) class="active"  @endif><a href="/index">主页</a></li>
                <li @if (getSidebarActiveIndex('list')) class="active"  @endif><a href="/list">模板列表 </a></li>
            </ul>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if(auth()->check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">个人中心 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/creat">新建模板</a></li>
                                <li><a href="/my">我的模板</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/dashboard">仪表盘</a></li>
                                <li><a href="/log">日志</a></li>
                                <li><a href="/message">消息</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/logout">注销</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="/register">注册</a></li>
                        <li><a href="/login">登录</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>