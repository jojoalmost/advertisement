@extends('layouts.frontend')
@section('head_extra')
    <link href="{{url('/css/videojs/video-js.css')}}" rel="stylesheet">
    <script src="{{url('/js/videojs/video.js')}}"></script>
    <script src="{{url('/js/videojs/videojs.disableProgress.js')}}"></script>
    <script src="{{url('/js/videojs/videojs-playlist.js')}}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        .my-video-dimensions {
            width: auto;
            height: 480px;
        }

        .panel {
            padding-top: 20px;
            min-height: 620px;
        }

        @media screen and (max-device-width: 380px) {
            .my-video-dimensions {
                height: 180px;
            }
        }

        @media screen and (max-device-height: 380px) {
            .my-video-dimensions {
                height: 300px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="row panel panel-default">
        <div class="col-xs-12">
            <h2 class="text-center">{{ $data->name }}</h2>
        </div>
        <div class="col-xs-12">
            <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls
                   width="640" height="360"
                   poster="" data-setup='{}'>
                <source src="{{url('/uploads/video/'.$data->video)}}" type="video/mp4"/>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                    <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video>
            <div class="col-xs-12 text-center">
                <form action="{{url('cloudtraxauth')}}" method="post" id="skip" style="display: none">
                    {!! csrf_field() !!}
                    <input type="hidden" name="advertisement_id" value="{{$data->id}}">
                    <button class="btn btn-raised btn-primary btn-lg">Skip
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('body_extra')
    <script>
        var skipped = "{{$data->skipped}}";
        var skipbool = false;
        if (skipped == "yes") {
            skipbool = true;
        }

        // save a reference to the video element
        video = document.querySelector('video');

        // disable right click
        if (video.addEventListener) {
            video.addEventListener('contextmenu', function (e) {
                e.preventDefault();
            }, false);
        } else {
            video.attachEvent('oncontextmenu', function () {
                window.event.returnValue = false;
            });
        }

        // save a reference to the video.js player for that element
        player = videojs(video, {"controls": true, "autoplay": true, "preload": "auto"});


        // initialize the plugin, passing in autoDisable
        player.disableProgress({
            autoDisable: true
        });

        video.onprogress = function () {
                    {{$timer}}
                        @if($skipdurationSet->skip_duration == "yes")
                        {{$timer = $skipdurationSet->duration}}
                        @else
                        {{$timer = $data->skip_duration}}
                        @endif
                       var skip_duration = '{{$timer}}';
            if (skipbool) {
                if (video.currentTime >= skip_duration) {
                    $('#skip').show();
                }
            }
        };

        player.on('ended', function () {
            skipbool = false;
            $('#skip').hide();
            $.ajax({
                type: 'POST',
                url: '{{url('cloudtraxauth')}}',
                data: $('form').serialize(),
                success: function () {
                    window.location.href = "{{url('cloudtraxauth')}}";
                }
            });
        })


    </script>
@endsection
