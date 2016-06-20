@extends('layouts.admin')

@section('content')
    <div class="panel-body">
        <!-- New Task Form -->
        <form action="{{url('admin/portal_mode/update')}}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            {!! method_field('put') !!}

            <div class="form-group">
                <label for="select111" class="col-md-3 control-label">Portal Mode</label>

                <div class="col-md-6">
                    <select id="portal_mode" name="portal_mode" class="form-control">
                        <option value="without">Without URL redirection</option>
                        <option value="with">With URL redirection</option>
                        <option value="radius">Using Radius User to redirect URL</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-5 pull-right">
                    <button class="btn btn-raised btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('body_extra')
    <script>
        $(function(){
            $("#portal_mode").val("{{$data->value}}");
        })
    </script>
@endsection