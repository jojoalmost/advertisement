@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/default_packages')}}" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Username</label>

                <div class="col-sm-6">
                    <input type="text" name="billing_type" id="billing_type" class="form-control" placeholder="Usernamee">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Password</label>

                <div class="col-sm-6">
                    <input type="text" name="disk_space" id="disk_space" class="form-control" placeholder="Disk Space">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 pull-right">
                    <a href="{{url('admin/default_packages')}}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
