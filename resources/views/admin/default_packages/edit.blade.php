@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/advertisement/'.$data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Billing Type</label>

                <div class="col-sm-6">
                    <input type="text" name="billing_type" id="billing_type" class="form-control" value="{{$data->billing_type}}" placeholder="Billing Type">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Disk Space</label>

                <div class="col-sm-6">
                    <input type="text" name="disk_space" id="disk_space" class="form-control" value="{{$data->disk_space}}" placeholder="Disk Space">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Total Disk Space Price</label>

                <div class="col-sm-6">
                    <input type="text" name="total_disk_space_price" id="total_disk_space_price" class="form-control" value="{{$data->total_disk_space_price}}" placeholder="Total Disk Space Price">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Allocated Bandwith</label>

                <div class="col-sm-6">
                    <input type="text" name="allocated_bandwith" id="allocated_bandwith" class="form-control" value="{{$data->allocated_bandwith}}" placeholder="Allocated Bandwith">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Allocated Airtime</label>

                <div class="col-sm-6">
                    <input type="text" name="allocated_airtime" id="allocated_airtime" class="form-control" value="{{$data->allocated_airtime}}" placeholder="Allocated Airtime">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Allocated Number of Plays</label>

                <div class="col-sm-6">
                    <input type="text" name="allocated_number_of_plays" id="allocated_number_of_plays" class="form-control" value="{{$data->allocated_number_of_plays}}" placeholder="Allocated Number of Plays">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-3 control-label">Can Exceed</label>

                <div class="col-md-6">
                    <select id="can_exceed" name="can_exceed" class="form-control">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Monthly Price</label>

                <div class="col-sm-6">
                    <input type="text" name="monthly_price" id="monthly_price" class="form-control" value="{{$data->monthly_price}}" placeholder="Monthly Price">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Bandwidth Rates</label>

                <div class="col-sm-6">
                    <input type="text" name="bandwidth_rates" id="bandwidth_rates" class="form-control" value="{{$data->bandwidth_rates}}" placeholder="Bandwidth Rates">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Air Time Rate</label>

                <div class="col-sm-6">
                    <input type="text" name="air_time_rate" id="air_time_rate" class="form-control" value="{{$data->air_time_rate}}" placeholder="Air Time Rate">
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
@section('body_extra')
    <script>
        $(function(){
            $("#can_exceed").val("{{@$data->can_exceed}}");
//            if($("#portal_mode").val() == 0) //I'm supposing the "Other" option value is 0.
//                $("#yourTextBox").hide();
        })
    </script>
@endsection