@extends('layouts.admin')

@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/advertisement/'.$data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" value="{{$data->name}}" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-3 control-label">Mp4 File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" value="{{$data->video_mp4}}" placeholder="Browse...">
                    <input type="file" name="video_mp4" id="video" value="{{$data->video_mp4}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-3 control-label">Ogg File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" value="{{$data->video_ogg}}" placeholder="Browse...">
                    <input type="file" name="video_ogg" id="video" value="{{$data->video_ogg}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-3 control-label">Webm File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" value="{{$data->video_webm}}" placeholder="Browse...">
                    <input type="file" name="video_webm" id="video" value="{{$data->video_webm}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-3 control-label">H264 File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" value="{{$data->video_h264}}" placeholder="Browse...">
                    <input type="file" name="video_h264" id="video" value="{{$data->video_h264}}">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Redirect URL</label>

                <div class="col-sm-6">
                    <input type="text" name="redirect_url" id="redirect_url" class="form-control" value="{{$data->redirect_url}}" placeholder="Redirect URL">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Valid Runs</label>

                <div class="col-sm-6">
                    <input type="text" name="max_played" id="max_played" class="form-control" value="{{$data->max_played}}" placeholder="Valid Runs">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Skip Duration</label>

                <div class="col-sm-6">
                    <input type="text" name="skip_duration" id="skip_duration" class="form-control" value="{{$data->skip_duration}}" placeholder="Skip Duration">
                    <p class="help-block">Set duration value in second</p>
                    <div class="checkbox col-sm-3">
                        <label class="control-label">
                            <input type="checkbox" name="skipped" @if($data->skipped == "yes") checked @endif><span class="check"></span></span> Skipped
                        </label>
                        <label class="control-label">
                            <input type="checkbox" name="active" @if($data->active == "yes") checked @endif><span class="check"></span></span> Active
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 pull-right">
                    <a href="{{url('admin/adstest/'.$data->id)}}" target="_blank" class="btn btn-warning">Test Play Ads</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 pull-right">
                    <a href="{{url('admin/advertisement')}}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
