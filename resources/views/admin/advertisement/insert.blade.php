@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/advertisement')}}" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-3 control-label">Mp4 File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" placeholder="Browse...">
                    <input type="file" name="video_mp4" id="video">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-3 control-label">Ogg File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" placeholder="Browse...">
                    <input type="file" name="video_ogg" id="video">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-3 control-label">Webm File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" placeholder="Browse...">
                    <input type="file" name="video_webm" id="video">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFile" class="col-md-3 control-label">H264 File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" placeholder="Browse...">
                    <input type="file" name="video_h264" id="video">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Redirect URL</label>

                <div class="col-sm-6">
                    <input type="text" name="redirect_url" id="redirect_url" class="form-control" placeholder="Redirect URL">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Valid Runs</label>

                <div class="col-sm-6">
                    <input type="text" name="max_played" id="max_played" class="form-control" placeholder="Valid Runs">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Skip Duration</label>
                <div class="col-sm-6">
                    <input type="text" name="skip_duration" id="skip_duration" class="form-control" placeholder="Skip Duration">
                    <p class="help-block">Set duration value in second</p>
                    <div class="checkbox">
                        <label class="control-label col-sm-3">
                            <input type="checkbox" name="skipped"><span class="check"></span></span> Skipped
                        </label>
                        <label class="control-label col-sm-3">
                            <input type="checkbox" name="active"><span class="check"></span></span> Active
                        </label>
                    </div>
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
