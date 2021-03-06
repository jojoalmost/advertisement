@extends('layouts.admin')
@section('head_extra')
    <meta name="_xhr_token" content="{{csrf_token()}}"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>
                        User Manager
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="panel-fab">
                        <a href="{{url('admin/user_manager/create')}}" class="btn btn-primary btn-fab">
                            <i class="material-icons">add</i>
                        </a>
                    </div>
                    <table class="table table-hover table-striped sorted_table" id="data_table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>API Key</th>
                            <th>Active</th>
                            <th class="action"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $i =>$value)
                            <tr data-id="{{$value->id}}">
                                <td>{{$value->name}}</td>
                                <td>{{$value->username}}</td>
                                <td>{{$value->email}}</td>
                                <td>@if($value->role == 1) Admin @else Customers @endif</td>
                                <td>{{$value->key}}</td>
                                <td>
                                    @if($value->active == 'yes')
                                        <a href="{{url('admin/user_manager/set/deactive/'.$value->id)}}" name="active" class="btn btn-raised btn-success">Active<div class="ripple-container"></div></a>
                                        @else
                                        <a href="{{url('admin/user_manager/set/active/'.$value->id)}}" name="active" class="btn btn-raised btn-warning">Deactive<div class="ripple-container"></div></a>
                                    @endif
                                </td>

                                <td class="column-action">
                                    <div class="button-group">
                                        <a href="{{url('admin/user_manager/'.$value->id.'/edit')}}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{url('admin/user_manager/'.$value->id)}}" data-id="{{$value->id}}"
                                           class="text-danger" name="delete_link">
                                            <i class="material-icons">delete_forever</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('body_extra')
    <script>
        $(function () {
            $("[name=delete_link]").click(function (event) {

                event.preventDefault();
                var id = $(this).attr('data-id');

                $.ajax({
                    url: $(this).attr('href') + '?_token=' + $('[name=_xhr_token]').attr('content'),
                    type: 'delete',
                    success: function (xhr) {
                        $('#data_table').find('tr[data-id=' + id + ']').remove();

                        if ($('#data_table').find('tbody tr').length == 1) {
                            $('#empty_marker').css('display', 'table-row');
                        }
                    },
                });
            });

            $("[name=active]").click(function (event) {

                event.preventDefault();
                var id = $(this).attr('data-id');

                $.ajax({
                    url: $(this).attr('href') + '?_token=' + $('[name=_xhr_token]').attr('content'),
                    type: 'get',
                    success: function (xhr) {
                        location.reload()
                    },
                });
            });
        })
    </script>
@endsection
