<!DOCTYPE html>
<html lang="en">
<head>
    <title>Advertisement</title>

    <!-- CSS And JavaScript -->
    <script src="{{url('/js/jquery-2.2.2.min.js')}}"></script>
    <script src="{{url('/js/bootstrap.js')}}"></script>
    <script src="{{url('/js/material.js')}}"></script>
    <script src="{{url('/js/ripples.js')}}"></script>
    <script src="{{url('/js/jquery-sortable.js')}}"></script>

    <link rel="stylesheet" href="{{url('/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('/css/bootstrap-material-design.css')}}">
    <link rel="stylesheet" href="{{url('/css/ripples.css')}}">
    <link rel="stylesheet" href="{{url('/css/custom.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('/css/font-material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/icon-material.css')}}">
    @yield(('head_extra'))
</head>

<body>
<nav class="navbar navbar-warning">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('admin/dashboard')}}">Cloudtrax Ads</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"> </span> Menu</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/advertisement')}}">Advertisement</a></li>
                        <li><a href="{{url('admin/radius')}}">Radius</a></li>
                        <li><a href="{{url('admin/bandwith')}}">Bandwith Manager</a></li>
                        <li><a href="{{url('admin/terms')}}">Terms Edit</a></li>
                        <li><a href="{{url('admin/log')}}">Advertisement Log</a></li>
                        <li><a href="{{url('admin/report')}}">Report</a></li>
                        <li><a href="{{url('admin/portal_mode')}}">Portal Mode</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"> </span> Billing Portal</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/default_packages')}}">Default Packages</a></li>
                        <li><a href="{{url('admin/customer_settings')}}">Customer Settings</a></li>
                        <li><a href="{{url('admin/rates_price')}}">Rates - Price</a></li>
                        <li><a href="{{url('admin/billing_entries')}}">Biling Entries</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('auth/logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
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
