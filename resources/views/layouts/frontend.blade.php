<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel Quickstart - Basic</title>

    <!-- CSS And JavaScript -->
    <script src="{{url('/js/jquery-2.2.2.min.js')}}"></script>
    <script src="{{url('/js/bootstrap.js')}}"></script>
    <script src="{{url('/js/material.js')}}"></script>
    <script src="{{url('/js/ripples.js')}}"></script>

    <link rel="stylesheet" href="{{url('/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('/css/bootstrap-material-design.css')}}">
    <link rel="stylesheet" href="{{url('/css/ripples.css')}}">
    <link rel="stylesheet" href="{{url('/css/custom.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('/css/font-material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/icon-material.css')}}">
    @yield(('head_extra'))
</head>

<body>
<div class="container">
@yield('content')
</div>
@yield('body_extra')
<script>
    $(function(){
        $.material.init();
    })
</script>
</body>
</html>
