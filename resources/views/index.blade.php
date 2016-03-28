@extends('layouts.frontend')
@section('head_extra')
    <link href="{{url('/css/videojs/video-js.css')}}" rel="stylesheet">
    <script src="{{url('/js/videojs/video.js')}}"></script>
    <script src="{{url('/js/videojs/videojs.disableProgress.js')}}"></script>
    <script src="{{url('/js/videojs/videojs-playlist.js')}}"></script>
    <style>

        /*body {*/
        /*background-color: #B71C1C;*/
        /*}*/

        /*.center {*/
        /*margin: 0 auto;*/
        /*}*/

        /*.content {*/
        /*margin: 0 auto;*/
        /*padding-top: 40px;*/
        /*padding-bottom: 100px;*/
        /*max-width: 1920px;*/
        /*}*/

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="content panel panel-default">
            <div class="col-md-12">
                {{ $data->name }}
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
                    <form action="{{url('cloudtraxauth/')}}" method="post" id="skip" style="display: none">
                        {!! csrf_field() !!}
                        <input type="hidden" name="advertisement_id" value="{{$data->id}}">
                        <button class="btn btn-raised btn-primary btn-lg">Skip
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('body_extra')
    <script>
        // save a reference to the video element
        video = document.querySelector('video');

        // save a reference to the video.js player for that element
        player = videojs(video, {"controls": false, "autoplay": true, "preload": "auto"});

        // initialize the plugin, passing in autoDisable
        player.disableProgress({
            autoDisable: true
        });

        player.on('progress', on_progress);


        function on_progress(event) {
            var skip_duration = {{$data->skip_duration}};
            if (player.currentTime() >= skip_duration) {
                $('#skip').show();
            }
        }

        player.on('ended', function () {
            $('#skip').hide();
            {{--$.ajax({--}}
            {{--url: '{{url('fetch/')}}/' + (counter++),--}}
            {{--type: 'get',--}}
            {{--success: function (value) {--}}
            {{--player.src({src: "{{url('/uploads/video/')}}/" + value.video, type: "video/mp4"});--}}
            {{--player.play();--}}
            {{--},--}}
            {{--})--}}
            {{--$.ajax({--}}
            {{--url: '{{url('index')}}',--}}
            {{--type: 'post',--}}
            {{--data: {--}}
            {{--url: $(video).attr('src'),--}}
            {{--_token: '{{csrf_token()}}'--}}
            {{--},--}}
            {{--})--}}
        });

        //        var counter = 1;
        //        var player;
        //        $(function () {
        //            player = videojs("#my-video", {"controls": false,"autoplay": true, "preload": "auto"});
        {{--$.ajax({--}}
        {{--url: '{{url('fetch/')}}/' + (counter++),--}}
        {{--type: 'get',--}}
        {{--success: function (value) {--}}
        {{--player.src({src: "{{url('/uploads/video/')}}/" + value.video, type: "video/mp4"});--}}
        {{--//                    player.play(); //autoplay--}}
        {{--//                    player.loadstart();--}}
        {{--}--}}
        {{--})--}}

        //        });

    </script>
@endsection
