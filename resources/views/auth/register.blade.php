@extends('layouts.wide')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
        @endforeach
    @endif
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="/register">
                @csrf
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">电子邮箱</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="请输入电子邮箱">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" maxlength="64"
                               placeholder="请输入密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password_confirmation" maxlength="64"
                               name="password_confirmation" placeholder="请输入确认密码">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">注册</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
