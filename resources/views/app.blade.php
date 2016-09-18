<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <link link rel="icon" type="image/ico" href="{!! asset('img/favicon.ico') !!}">
    <title>好邻居</title>

    <!-- Fonts -->
{{--    <link rel="stylesheet" href="{{ url('css/libs/font-awesome.min.css')}}">--}}
    {{--<link rel="stylesheet" href="{{ url('css/libs/Lato.css') }}">--}}

    <!-- Styles -->
{{--    <link rel="stylesheet" href=" {{ url('css/libs/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    @yield('header')
</head>
<body id="app-layout">
@include('partial.nav')

@yield('content')

        <!-- JavaScripts -->
{{--<script src="{{ url('js/libs/jquery.min.js') }}"></script>--}}
<script src="//cdn.bootcss.com/jquery/2.1.1-rc2/jquery.min.js"></script>
{{--<script src="{{ url('js/libs/bootstrap.min.js') }}"></script>--}}
<script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
@yield('footer')
</body>
</html>
