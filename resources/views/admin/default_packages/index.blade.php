@extends('layouts.admin')
@section('head_extra')
    <meta name="_xhr_token" content="{{csrf_token()}}"/>
    <style>
        body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        table tr.placeholder {
            position: relative;
        }

        table tr.placeholder:before {
            position: absolute;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>
                        Default Packages
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="panel-fab">
                        <a href="{{url('admin/advertisement/create')}}" class="btn btn-primary btn-fab">
                            <i class="material-icons">add</i>
                        </a>
                    </div>
                    <table class="table table-hover table-striped sorted_table" id="data_table">
                        <thead>
                        <tr>
                            <th>Billing Type UID (cannot be changed)</th>
                            <th>Customer Billing Type</th>
                            <th>Disk space (in mb)</th>
                            <th>Disk space total price</th>
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
                            <th class="action"></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($data as $i =>$value)--}}
                            {{--<tr data-id="{{$value->id}}">--}}
                                {{--<td>{{$i+1}}</td>--}}
                                {{--<td>{{$value->name}}</td>--}}
                                {{--<td>{{$value->max_played}}</td>--}}
                                {{--<td>{{$value->played}}</td>--}}
                                {{--<td>{{$value->skip_duration}}</td>--}}
                                {{--<td>{{$value->active}}</td>--}}
                                {{--<td class="column-action">--}}
                                    {{--<div class="button-group">--}}
                                        {{--<a href="{{url('admin/advertisement/'.$value->id.'/edit')}}">--}}
                                            {{--<i class="material-icons">edit</i>--}}
                                        {{--</a>--}}
                                        {{--<a href="{{url('admin/advertisement/'.$value->id)}}" data-id="{{$value->id}}"--}}
                                           {{--class="text-danger" name="delete_link">--}}
                                            {{--<i class="material-icons">delete_forever</i>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
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

//                        var options = {
//                            content: 'Data Deleted.',
//                            style: 'snackbar',
//                            timeout: 2500
//                        };

                        $('#data_table').find('tr[data-id=' + id + ']').remove();

                        if ($('#data_table').find('tbody tr').length == 1) {
                            $('#empty_marker').css('display', 'table-row');
                        }
                    },
//                    error: function (xhr) {
//                        var options = {
//                            content: 'Terjadi kesalahan saat mencoba menghapus data AXA.',
//                            style: 'snackbar',
//                            timeout: 2500
//                        };
//                    }
                });
            });
        })
    </script>
@endsection
