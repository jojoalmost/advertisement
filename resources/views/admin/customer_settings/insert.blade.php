@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/advertisement')}}" method="POST" class="form-horizontal"
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

                <div class="col-sm-6">
                    <input type="text" name="default_package" id="default_package" class="form-control" placeholder="Default Packages" disabled="disabled">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#complete-dialog">...</button>
                    <input type="hidden" name="default_package_id" id="default_package_id" class="form-control" placeholder="Default Packages">
                    <input type="hidden" name="disk_space_available" id="disk_space_available" class="form-control" placeholder="Default Packages">
                </div>
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
                    <input type="text" name="credit_terms" id="credit_terms" class="form-control" placeholder="Credit Terms">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Credit Limit</label>

                <div class="col-sm-6">
                    <input type="text" name="credit_limit" id="credit_limit" class="form-control" placeholder="Credit Limit">
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
                    <input type="text" name="max_active_videos" id="max_active_videos" class="form-control" placeholder="Max Active Videos">
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
                    <h4 class="modal-title">Dialog</h4>
                </div>
                <div class="modal-body">
                    <table class="" id="">
                        <thead>
                        <tr>
                            <th>UID</th>
                            <th>Billing Type</th>
                            <th>Disk space</th>
                            <th>Disk space price</th>
                            <th>Allocated Bandwidth (per month)</th>
                            <th>Allocated airtime(secs)
                                (per month)</th>
                            <th>Allocated
                                Number of Plays
                                (per month)</th>
                            <th>Can exceed</th>
                            <th>Monthly price</th>
                            <th>Bandwidth rates (per gig)</th>
                            <th>Air time rate( per sec)</th>
                            <th>Per Play rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modal as $i =>$value)
                            <tr data-id="{{$value->id}}">
                                <td>{{$value->id}}</td>
                                <td>{{$value->billing_type}}</td>
                                <td>{{$value->disk_space}}</td>
                                <td>{{$value->total_disk_space_price}}</td>
                                <td>{{$value->allocated_bandwith}}</td>
                                <td>{{$value->allocated_airtime}}</td>
                                <td>{{$value->allocated_number_of_plays}}</td>
                                <td>{{$value->can_exceed}}</td>
                                <td>{{$value->monthly_price}}</td>
                                <td>{{$value->bandwidth_rates}}</td>
                                <td>{{$value->air_time_rate}}</td>
                                <td>{{$value->per_play_rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Dismiss<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: 34.6563px; top: 9px; transform: scale(10.875); background-color: rgb(0, 150, 136);"></div><div class="ripple ripple-on ripple-out" style="left: 36.6563px; top: 19px; transform: scale(10.875); background-color: rgb(0, 150, 136);"></div><div class="ripple ripple-on ripple-out" style="left: 45.6563px; top: 21px; transform: scale(10.875); background-color: rgb(0, 150, 136);"></div></div></button>
                </div>
            </div>
        </div>
    </div>
@endsection
