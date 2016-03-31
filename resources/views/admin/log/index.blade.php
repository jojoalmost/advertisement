@extends('layouts.admin')
@section('head_extra')
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>
                        ADS USER LOG
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-striped sorted_table" id="data_table">
                        <thead>
                        <tr>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Watched</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $value)
                            <tr data-id="{{$value->id}}">
                                <td>{{$value->created_at->format('Y-m-d')}}</td>
                                <td>{{$value->created_at->format('H:i:s')}}</td>
                                <td>{{$value->}}</td>
                                <td>{{$value->ip_address}}</td>
                                <td>{{$value->user_agent}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
