@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/customer_settings')}}" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Customer</label>

                <div class="col-sm-6">
                    <input type="text" name="customer" id="customer" class="form-control" placeholder="Customer">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Default Packages</label>

                <div class="col-sm-5">
                    <input type="text" id="default_package" class="form-control"
                           placeholder="Default Packages" disabled="disabled" data-target="default_package">
                    <input type="hidden" name="default_package_id" id="default_package_id" data-target="default_package_id">
                    <input type="hidden" name="disk_space_available" id="disk_space_available" data-target="disk_space_available">
                </div>
                <div class="col-sm-1"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#complete-dialog">
                        ...
                    </button></div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Directory</label>

                <div class="col-sm-6">
                    <input type="text" name="directory" id="directory" class="form-control" placeholder="Directory">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Credit Terms</label>

                <div class="col-sm-6">
                    <input type="text" name="credit_terms" id="credit_terms" class="form-control"
                           placeholder="Credit Terms">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Credit Limit</label>

                <div class="col-sm-6">
                    <input type="text" name="credit_limit" id="credit_limit" class="form-control"
                           placeholder="Credit Limit">
                </div>
            </div>
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
                <label for="name" class="col-sm-3 control-label">Max Active Videos</label>

                <div class="col-sm-6">
                    <input type="text" name="max_active_videos" id="max_active_videos" class="form-control"
                           placeholder="Max Active Videos">

                    <div class="checkbox">
                        <label class="control-label col-sm-3">
                            <input type="checkbox" name="active"><span class="check"></span></span> Active
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 pull-right">
                    <a href="{{url('admin/customer_setting')}}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>


    <div id="complete-dialog" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Default Packages</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-striped" id="default-packages-table">
                        <thead>
                        <tr>
                            <th>UID</th>
                            <th>Billing Type</th>
                            <th>Disk space</th>
                            <th>Disk space price</th>
                            <th>Monthly price</th>
                            <th>Air time rate( per sec)</th>
                            <th>Per Play rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modal as $i =>$value)
                            <tr data-id="{{$value->id}}" data-disk = "{{$value->disk_space}}" data-type="{{$value->billing_type}}">
                                <td>{{$value->id}}</td>
                                <td>{{$value->billing_type}}</td>
                                <td>{{$value->disk_space}}</td>
                                <td>{{$value->total_disk_space_price}}</td>
                                <td>{{$value->monthly_price}}</td>
                                <td>{{$value->air_time_rate}}</td>
                                <td>{{$value->per_play_rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Dismiss
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('body_extra')
    <script>
        $("#default-packages-table").on('click', 'tr', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var disk_space = $(this).attr('data-disk');
            var billing_type =  $(this).attr('data-type');
            $('#complete-dialog').modal('hide');
            $('#default_package').val(billing_type);
            $('#default_package_id').val(id);
            $('#disk_space_available').val(disk_space);
        });
    </script>
@endsection
