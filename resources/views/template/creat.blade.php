@extends('layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="/creat">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" class="form-control" id="template-name" name="template-name" placeholder="模板名称">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">描述</label>
            <input type="text" class="form-control" id="template-desc" name="template-desc" placeholder="模板描述">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">HAR文件</label>
            <textarea type="text" class="form-control" id="har-text" name="har-text" placeholder="请粘贴HAR文件，JSON格式"
                      rows="8"
                      style="resize:none"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">需要替换的Header字段</label>
            <textarea type="text" class="form-control" id="header-replace" name="header-replace"
                      placeholder="需要替换的Header字段，一般为Cookies，[Cookie,Host,User-Agent,...]"
                      rows="4"
                      style="resize:none"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">需要替换的Query字段</label>
            <textarea type="text" class="form-control" id="query-replace" name="query-replace"
                      placeholder="需要替换的Query/GET字段，没有Query/GET字段则为空，[a,b,c,...]"
                      rows="4"
                      style="resize:none"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">需要替换的POST字段</label>
            <textarea type="text" class="form-control" id="post-replace" name="post-replace"
                      placeholder="需要替换的POST字段，非POST请求则字段则为空，[a,b,c,...]"
                      rows="4"
                      style="resize:none"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">成功时的响应</label>
            <textarea type="text" class="form-control" id="success-response" name="success-response"
                      placeholder='成功时的响应的某些字段，多个字段取并值，例如{"code":200}，JSON格式'
                      rows="4"
                      style="resize:none"></textarea>
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>

@endsection
