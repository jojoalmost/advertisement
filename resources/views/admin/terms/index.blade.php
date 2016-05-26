@extends('layouts.admin')
@section('head_extra')
    <script src="{{url('/js/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <!-- New Task Form -->
                    <form action="{{url('admin/terms/update')}}" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}
                        {!! method_field('put') !!}
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-sm-8">
                <textarea class="form-control" placeholder="placeholder without label" name="terms" id="terms">
                    {{$data->value}}
                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 pull-right">
                                <button class="btn btn-raised btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('body_extra')
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('terms');
        });
    </script>
@endsection