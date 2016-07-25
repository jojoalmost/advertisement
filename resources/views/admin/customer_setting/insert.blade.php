@extends('layouts.admin')
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/advertisement')}}" method="POST" class="form-horizontal"
              enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Entry UID</label>

                <div class="col-sm-6">
                    <input type="text" name="uid" id="uid" class="form-control" placeholder="Entry UID">
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
                <label for="name" class="col-sm-3 control-label">Amount to add/reduce</label>

                <div class="col-sm-6">
                    <input type="text" name="amoount" id="amount" class="form-control"
                           placeholder="Amount to add/reduce">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Used by</label>

                <div class="col-sm-6">
                    <input type="text" name="used" id="used" class="form-control" placeholder="Used by">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-sm-8">
                <textarea class="form-control" placeholder="placeholder without label" name="notes" id="notes">
                </textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6 pull-right">
                    <a href="{{url('admin/advertisement')}}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
