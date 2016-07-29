@extends('layouts.admin')

@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/customer_settings/'.$data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Customer</label>

                <div class="col-sm-5">
                    <input type="text" id="customer" class="form-control"
                           placeholder="Customer" disabled="disabled" data-target="customer">
                    <input type="hidden" name="user_id" id="user_id" data-target="user_id">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Default Packages</label>

                <div class="col-sm-6">
                    <input type="text" id="default_package" class="form-control"
                           placeholder="Default Packages" disabled="disabled">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#default-package-modal">
                        ...
                    </button>
                    <input type="hidden" name="default_package_id" id="default_package_id" class="form-control"
                           value="{{$data->default_package_id}}" placeholder="Default Packages">
                    <input type="hidden" name="disk_space_available" id="disk_space_available" class="form-control"
                           value="{{$data->disk_space_available}}" placeholder="Default Packages">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Directory</label>

                <div class="col-sm-6">
                    <input type="text" name="directory" id="directory" class="form-control" value="{{$data->directory}}" placeholder="Directory">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Credit Terms</label>

                <div class="col-sm-6">
                    <input type="text" name="credit_terms" id="credit_terms" class="form-control"
                           value="{{$data->credit_terms}}" placeholder="Credit Terms">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Credit Limit</label>

                <div class="col-sm-6">
                    <input type="text" name="credit_limit" id="credit_limit" class="form-control"
                           value="{{$data->credit_limit}}" placeholder="Credit Limit">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Max Active Videos</label>

                <div class="col-sm-6">
                    <input type="text" name="max_active_videos" id="max_active_videos" class="form-control"
                           value="{{$data->max_active_videos}}" placeholder="Max Active Videos">

                    <div class="checkbox">
                        <label class="control-label col-sm-3">
                            <input type="checkbox" name="active" @if($data->active == "yes") checked @endif><span class="check"></span> Active
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
    <div id="user-modal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Default Packages</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-striped" id="user-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modal2 as $i =>$value)
                            <tr data-id="{{$value->id}}" data-value1 = "{{$value->name}}">
                                <td>{{$value->name}}</td>
                                <td>{{$value->username}}</td>
                                <td>{{$value->email}}</td>
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

    <div id="default-package-modal" class="modal fade">
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
            console.log(id,disk_space,billing_type);
            $('#default-package-modal').modal('hide');
            $('#default_package').val(billing_type);
            $('#default_package_id').val(id);
            $('#disk_space_available').val(disk_space);
        });
        $("#user-table").on('click', 'tr', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var value1 = $(this).attr('data-value1');
            $('#user-modal').modal('hide');
            $('#user_id').val(id);
            $('#customer').val(value1);
        });
    </script>
@endsection