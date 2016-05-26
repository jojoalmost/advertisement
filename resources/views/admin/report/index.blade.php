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
                        Report
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-striped sorted_table" id="data_table">
                        <thead>
                        <tr>
                            <th>Destcription</th>
                            <th>Filename</th>
                            <th class="action"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $value)
                                <td>{{$value->name}}</td>
                                <td>{{$value->video}}</td>
                                <td class="column-action">
                                    <div class="button-group">
                                        <a href="{{url('admin/advertisement/'.$value->id.'/edit')}}">
                                            <i class="material-icons">visibility</i>
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
