<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{config('app.name')}}</title>
    <link href="{{ asset('css/bootstrap.yeti.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">
</head>
<body>

@component('component.header')
@endcomponent

<div class="{{ config('view.prefix') }}-container container">
    @yield('container')
</div>
@component('component.footer')
@endcomponent
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
