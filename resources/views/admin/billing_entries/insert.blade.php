@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/billing_entries')}}" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
            {!! csrf_field() !!}

            {{--<div class="form-group">--}}
            {{--<label for="name" class="col-sm-3 control-label">Entry UID</label>--}}

            {{--<div class="col-sm-6">--}}
            {{--<input type="text" name="uid" id="uid" class="form-control" placeholder="Entry UID">--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Used By</label>

                <div class="col-sm-5">
                    <input type="text" id="customer" class="form-control"
                           placeholder="Used By" disabled="disabled" data-target="customer">
                    <input type="hidden" name="user_id" id="user_id" data-target="user_id">
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-modal">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Document Reference Number</label>

                <div class="col-sm-6">
                    <input type="text" name="doc_ref_no" id="doc_ref_no" class="form-control"
                           placeholder="Document Reference Number">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Amount</label>
                <div class="col-sm-1">
                    <select id="amount" class="form-control">
                        <option value="add">+</option>
                        <option value="reduce">-</option>
                    </select>
                </div>
                <div class="col-sm-5">
                    <input type="text" name="amount" id="amount" class="form-control"
                           placeholder="Amount">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Notes</label>

                <div class="col-sm-6">
                <textarea class="form-control" placeholder="Notes" name="notes" id="notes">
                </textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6 pull-right">
                    <a href="{{url('admin/billing_entries')}}" class="btn btn-default">Cancel</a>
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
                    <h4 class="modal-title">User</h4>
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
                        @foreach($modal as $i =>$value)
                            <tr data-id="{{$value->id}}" data-value1="{{$value->name}}">
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
@endsection
@section('body_extra')
    <script>
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