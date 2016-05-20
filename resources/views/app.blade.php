<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>好邻居</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ url('css/libs/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ url('css/libs/Lato.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href=" {{ url('css/libs/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ url('css/libs/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body id="app-layout">
@include('partial.nav')

@yield('content')

        <!-- JavaScripts -->
<script src="{{ url('js/libs/jquery.min.js') }}"></script>
<script src="{{ url('js/libs/bootstrap.min.js') }}"></script>
<script src="{{ url('js/libs/select2.min.js') }}"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
@yield('footer')
</body>
</html>
