@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/user_manager')}}" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Username</label>

                <div class="col-sm-6">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Password</label>

                <div class="col-sm-6">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Email</label>

                <div class="col-sm-6">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Phone</label>

                <div class="col-sm-6">
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Address</label>

                <div class="col-sm-6">
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
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
