@extends('layouts.admin')

@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/bandwith/update')}}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="">
                <div class="col-lg-offset-2 col-sm-1">
                    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox" name="up_active" @if($data->up_active == "yes") checked @endif>
                        </label>
                    </div>
                </div>
                <div class="form-group label-static">
                    <div class="col-sm-6">
                        <label for="max" class="control-label">WISPr-Bandwidth-Max-Up (Max bandwidth upload)</label>
                        <input type="text" class="form-control"  name="up" placeholder="Max" value="{{$data->up}}">
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-lg-offset-2 col-sm-1">
                    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox" name="down_active" @if($data->down_active == "yes") checked @endif>
                        </label>
                    </div>
                </div>
                <div class="form-group label-static">
                    <div class="col-sm-6">
                        <label for="min" class="control-label">WISPr-Bandwidth-Max-Down (Down bandwidth upload)</label>
                        <input type="text" class="form-control"  name="down" placeholder="Down" value="{{$data->down}}">
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-lg-offset-2 col-sm-1">
                    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox" name="timeout_active" @if($data->timeout_active == "yes") checked @endif>
                        </label>
                    </div>
                </div>
                <div class="form-group label-static">
                    <div class="col-sm-6">
                        <label for="session" class="control-label">SESSION_TIMEOUT(in seconds)</label>
                        <input type="text" class="form-control"  name="timeout" placeholder="Timeout" value="{{$data->timeout}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-5 pull-right">
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
