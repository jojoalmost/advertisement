@extends('layouts.admin')

@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/radius/update')}}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="form-group label-static">
                <div class="col-sm-offset-3 col-sm-6">
                <label for="Username" class="control-label">Radius Username</label>
                <input type="text" class="form-control"  name="username" placeholder="Radius Username" value="{{@$data->username}}">
                </div>
            </div>
            <div class="form-group label-static">
                <div class="col-sm-offset-3 col-sm-6">
                <label for="Password" class="control-label">Radius Password</label>
                <input type="text" class="form-control"  name="password" placeholder="Radius Password" value="{{@$data->password}}">
                </div>
            </div>
            <div class="form-group label-static">
                <div class="col-sm-offset-3 col-sm-6">
                <label for="Secret" class="control-label">Secret</label>
                <input type="text" class="form-control"  name="secret" placeholder="Secret" value="{{@$data->secret}}">
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
