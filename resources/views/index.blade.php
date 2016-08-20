@extends('layouts.frontend')
@section('head_extra')
    <link href="{{url('/css/videojs/video-js.css')}}" rel="stylesheet">
    <link href="{{url('/css/videojs/videojs.imageOverlay.css')}}" rel="stylesheet">
    <script src="{{url('/js/videojs/video.js')}}"></script>
    <script src="{{url('/js/ie8/videojs-ie8.js')}}"></script>
    <script src="{{url('/js/videojs/videojs.disableProgress.js')}}"></script>
    <script src="{{url('/js/videojs/videojs-playlist.js')}}"></script>
    <script src="{{url('/js/videojs/videojs.imageOverlay.js')}}"></script>
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
    <div class="row panel-default">
        <div class="">
            <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls
                   width="100%"
                   poster="" data-setup='{}'>

                <source src="{{url('/video/'.$data->user->id.'/'.$data->video_mp4)}}" type="video/mp4"/>
                <source src="{{url('/video/'.$data->user->id.'/'.$data->video_ogg)}}" type="video/ogg"/>
                <source src="{{url('/video/'.$data->user->id.'/'.$data->video_webm)}}" type="video/webm"/>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                    <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video>

            <form action="{{url('cloudtraxauth')}}" method="post" id="skip" style="display: none">
                {!! csrf_field() !!}
                <input type="hidden" name="advertisement_id" value="{{$data->id}}">
                <input type="hidden" name="video_duration">
                <input type="hidden" name="video_watched">
            </form>
        </div>
    </div>

@endsection
@section('body_extra')
    <script>
        $(function () {
            var skipped = "{{$data->skipped}}";
            if (skipped == "yes") {
                skipbool = true;
            }

            // save a reference to the video element
            video = document.querySelector('video');


            video.onprogress = function () {
                $('[name=video_watched]').val(video.currentTime);
            };


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
            player = videojs(video, {"controls": true, "autoplay": false, "preload": "auto"});


            // initialize the plugin, passing in autoDisable
            player.disableProgress({
                autoDisable: true
            });


            player.on('play', function () {
                $('[name=video_duration]').val(video.duration);
                if (video.requestFullscreen) {
                    video.requestFullscreen();
                } else if (video.mozRequestFullScreen) {
                    video.mozRequestFullScreen(); // Firefox
                } else if (video.webkitRequestFullscreen) {
                    video.webkitRequestFullscreen(); // Chrome and Safari
                }
            });

            player.on('ended', function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url('cloudtraxauth')}}',
                    data: $('#skip').serialize(),
                    success: function () {
                        window.location.href = "{{url('cloudtraxauth')}}";
                    }
                });
            });
            var skip_duration = 0;
            skip_duration = {{$timer = $data->skip_duration}};

            if (skipbool) {
                player.imageOverlay({
                    image_url: "{{url('/css/videojs/skip_button.png')}}",
                    opacity: 0.5,
                    start_time: skip_duration,
                    height: '5%'
                });

            }
            var titan = $(".my-video-dimensions");
            var width = $(window).width();
            var height = $(window).height();
            titan.css('width', width);
            titan.css('height', height);
        })


    </script>
@endsection
