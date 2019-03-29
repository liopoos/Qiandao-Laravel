@extends('layouts.narrow')

@section('title','创建模板')

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
            <input type="text" class="form-control" id="template-desc" name="template-desc" placeholder="简短的模板描述">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">HAR文件</label>
            <textarea type="text" class="form-control" id="har-text" name="har-text"
                      placeholder="请粘贴Charles的HAR文件，JSON格式"
                      rows="8"
                      style="resize:none"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">需要替换的Header字段</label>
            <p>⚠️ 需要替换的Header字段，一般为Cookies，[Cookie,Host,User-Agent,...]</p>
            <textarea type="text" class="form-control" id="header-replace" name="header-replace"
                      rows="4"
                      style="resize:none">["Cookie"]</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">需要替换的Query字段</label>
            <p>⚠️ 需要替换的Query/GET字段，没有Query/GET字段则为空，[a,b,c,...]</p>
            <textarea type="text" class="form-control" id="query-replace" name="query-replace"
                      rows="4"
                      style="resize:none">[]</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">需要替换的POST字段</label>
            <p>⚠️ 需要替换的POST字段，非POST请求则字段则为空，[a,b,c,...]</p>
            <textarea type="text" class="form-control" id="post-replace" name="post-replace"
                      rows="4"
                      style="resize:none">[]</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">成功时的响应</label>
            <p>⚠️ 成功时的响应的某些字段，可以为多个相同字段，例如[{"code":200},{"code":100}]，JSON格式</p>
            <textarea type="text" class="form-control" id="success-response" name="success-response"
                      rows="4"
                      style="resize:none">{"code":200}</textarea>
        </div>
        <div class="form-group">
            <label for="relation">成功响应字段关系</label>
            <select class="form-control" name="relation">
                <option value="1">所有的条件都需要满足</option>
                <option value="2">只需要其中一个条件满足</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default btn-block">提交</button>
    </form>

@endsection

@section('sidebar')
    <p><strong>💡 提示</strong></p>
    <p>需要粘贴来自Charles的HAR文件，如果没有Charles，也可以使用Chrome的De-Tool导出的HAR文件，但需要确认格式。</p>
@endsection
