@extends('layouts.frontend')
@section('content')
    <div class="row">
        <div class="col-xs-12 panel panel-default">
            <video controls autoplay muted width="640" height="264" poster="http://video-js.zencoder.com/oceans-clip.png">
                <source src="{{url('uploads/video/TROLLOLOL FULL - YouTube.mp4')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
@endsection
@section('body_extra')
    <script>
        $(function () {

            var video = document.getElementsByTagName("video")[0];

            video.addEventListener("playing", function () {
                alert('Video has been viewed!');
            }, true);

            var supposedCurrentTime = 0;
            video.addEventListener('timeupdate', function () {
                if (!video.seeking) {
                    supposedCurrentTime = video.currentTime;
                }
            });
// prevent user from seeking
            video.addEventListener('seeking', function () {
                // guard agains infinite recursion:
                // user seeks, seeking is fired, currentTime is modified, seeking is fired, current time is modified, ....
                var delta = video.currentTime - supposedCurrentTime;
                if (Math.abs(delta) > 0.01) {
                    console.log("Seeking is disabled");
                    video.currentTime = supposedCurrentTime;
                }
            });
// delete the following event handler if rewind is not required
            video.addEventListener('ended', function () {
                // reset state in order to allow for rewind
                supposedCurrentTime = 0;
            });

        })

    </script>
@endsection
