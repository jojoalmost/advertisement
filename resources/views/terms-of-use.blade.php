@extends('layouts.frontend')
@section('head_extra')
    <style>

        body {
            background-color: #009688;
            padding-top: 20px;
        }

        .margin-base-vertical {
            margin: 50px 0;
            padding-bottom: 20px;
        }

        h1 {
            text-align: center;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-6 col-md-offset-3 panel panel-default">

            <h1 class="margin-base-vertical">Terms of use</h1>
            <ol>
                <li>You will use this service in responsible manner.</li>
                <li>You will not hold the service providers liable for any damages whatsoever.</li>
            </ol>
            <div class="margin-base-vertical">
                <div class="col-xs-12 text-center">
                    <a href="{{url('index')}}" class="btn btn-raised btn-primary btn-lg">I Agree</a>
                </div>
            </div>
        </div><!-- //main content -->
    </div><!-- //row -->
@endsection
