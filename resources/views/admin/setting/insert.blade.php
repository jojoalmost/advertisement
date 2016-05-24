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
                <label for="inputFile" class="col-md-3 control-label">File</label>

                <div class="col-md-6">
                    <input type="text" readonly="" class="form-control" placeholder="Browse...">
                    <input type="file" name="video" id="video">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Max Played</label>

                <div class="col-sm-6">
                    <input type="text" name="max_played" id="max_played" class="form-control" placeholder="Max Played">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Skip Duration</label>
                <div class="col-sm-6">
                    <input type="text" name="skip_duration" id="skip_duration" class="form-control" placeholder="Skip Duration">
                    <p class="help-block">Set duration value in second</p>
                    <div class="checkbox">
                        <label class="control-label">
                            <input type="checkbox" name="skipped"><span class="check"></span></span> Skipped
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
