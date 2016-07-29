@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/user_manager/'.$data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Username</label>

                <div class="col-sm-6">
                    <input type="text" name="username" id="username" class="form-control" value="{{@$data->username}}" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Change Password</label>

                <div class="col-sm-6">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" value="{{@$data->name}}" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Email</label>

                <div class="col-sm-6">
                    <input type="email" name="email" id="email" class="form-control" value="{{@$data->email}}" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Phone</label>

                <div class="col-sm-6">
                    <input type="text" name="phone" id="phone" class="form-control" value="{{@$data->phone}}" placeholder="Phone">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Address</label>

                <div class="col-sm-6">
                    <input type="text" name="address" id="address" class="form-control" value="{{@$data->address}}" placeholder="Address">
                </div>
            </div>
            <div class="form-group">
                <label for="select" class="col-md-3 control-label">Role</label>

                <div class="col-md-6">
                    <select id="role" name="role" class="form-control">
                        <option value="1">Admin</option>
                        <option value="2">Customers</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 pull-right">
                    <a href="{{url('admin/user_manager')}}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('body_extra')
    <script>
        $(function(){
            $("#role").val("{{@$data->role}}");
        })
    </script>
@endsection