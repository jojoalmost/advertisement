@extends('layouts.admin')
@section('head_extra')
    <script src="{{url('/js/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/terms/update')}}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            {!! method_field('put') !!}
            <div class="form-group is-empty">
                <textarea class="form-control" placeholder="placeholder without label" name="terms" id="terms">
                    {{$data->value}}
                </textarea>
                <span class="material-input"></span></div>
            <div class="form-group">
                <div class="col-sm-2 pull-right">
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('body_extra')
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('terms');
        });
    </script>
@endsection