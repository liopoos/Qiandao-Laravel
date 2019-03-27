@extends('layouts.app')

@section('container')
    <div class="row">
        <div class="col-md-9 col-sm-12">
            @yield('content')
        </div>
        <div class="col-md-3 col-sm-12" style="margin: 40px 0;">
            @section('sidebar')
            @show
        </div>
    </div>
@endsection