@extends('views.layouts.frontend')
@section('head_extra')
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        body {
            background-color: #009688;
            padding-top: 20px;
        }

        .margin-base-vertical {
            margin: 50px 0;
        }

        h1 {
            text-align: center;
        }

        .panel{
            min-height: 325px;
        }


        @media screen and (max-device-width: 480px) {
            h1{
                padding-top: 30px;
                padding-bottom: 10px;
            }

            .panel{
                min-height: 325px;
            }


        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3 panel panel-default">

            <h1 class="margin-base-vertical">Terms of use</h1>
            <ol>
                <li>You will use this service in responsible manner.</li>
                <li>You will not hold the service providers liable for any damages whatsoever.</li>
            </ol>
            <div class="margin-base-vertical">
                <div class="col-xs-12 text-center">
                    <a href="{!!url('ads')!!}" class="btn btn-raised btn-primary btn-lg">I Agree</a>
                </div>
            </div>
        </div><!-- //main content -->
    </div><!-- //row -->
@endsection
