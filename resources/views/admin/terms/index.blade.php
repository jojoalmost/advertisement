@extends('layouts.admin')

@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/advertisement/')}}" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="">
                <div class="col-lg-offset-2 col-sm-1">
                    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox">
                        </label>
                    </div>
                </div>
                <div class="form-group label-floating is-empty">
                    <div class="col-sm-6">
                        <input type="text" class="form-control"><label
                                class="control-label">WISPr-Bandwidth-Max-Up (Max bandwidth upload)</label><span
                                class="material-input"></span>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-lg-offset-2 col-sm-1">
                    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox">
                        </label>
                    </div>
                </div>
                <div class="form-group label-floating is-empty">
                    <div class="col-sm-6">
                        <input type="text" class="form-control"><label
                                class="control-label">WISPr-Bandwidth-Max-Down (Max bandwidth download)</label><span
                                class="material-input"></span>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-lg-offset-2 col-sm-1">
                    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox">
                        </label>
                    </div>
                </div>
                <div class="form-group label-floating is-empty">
                    <div class="col-sm-6">
                        <input type="text" class="form-control"><label
                                class="control-label">SESSION_TIMEOUT(in seconds)</label><span
                                class="material-input"></span>
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
