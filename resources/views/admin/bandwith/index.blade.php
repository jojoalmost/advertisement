@extends('layouts.admin')

@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/advertisement/')}}" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="form-group label-floating is-empty">
                <div class="col-sm-offset-3 col-sm-6">
                    <input type="text" class="form-control"><label
                            class="control-label">WISPr-Bandwidth-Max-Up (Max bandwidth upload)</label><span
                            class="material-input"></span>
                </div>
            </div>
            <div class="form-group label-floating is-empty">
                <div class="col-sm-offset-3 col-sm-6">
                    <input type="text" class="form-control"><label
                            class="control-label">WISPr-Bandwidth-Max-Down (Max bandwidth download)</label><span
                            class="material-input"></span>
                </div>
            </div>
            <div class="form-group label-floating is-empty">
                <div class="col-sm-offset-3 col-sm-6">
                    <input type="text" class="form-control"><label
                            class="control-label">SESSION_TIMEOUT(in seconds)</label><span
                            class="material-input"></span>
                </div>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="name" class="col-sm-3 control-label">Skip Duration</label>--}}

                {{--<div class="col-sm-6">--}}
                    {{--<input type="text" name="skip_duration" id="skip_duration" class="form-control" value=""--}}
                           {{--placeholder="Skip Duration">--}}

                    {{--<p class="help-block">Set duration value in second</p>--}}

                    {{--<div class="checkbox">--}}
                        {{--<label class="control-label">--}}
                            {{--<input type="checkbox" name="skipped"><span class="check"></span></span> Skipped--}}
                        {{--</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="form-group">
                <div class="col-sm-6 pull-right">
                    <a href="{{url('admin/advertisement')}}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
