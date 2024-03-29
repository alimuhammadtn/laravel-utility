@extends('inc.main')
@section('content') 
<div class="container-fluid">      
    <div class="row m-0">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Transaction</div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/transactions') }}">
                            {{ csrf_field() }}

                           

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="title" value="{{ old('title') }}"
                                           required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="display_name" class="col-md-4 control-label">Amount:</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="amount" value="{{ old('amount') }}"
                                           required autofocus>

                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea rows="4" cols="50" name="description" id="description" class="form-control">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('created') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Date</label>

                                <div class="col-md-6">
                                    <input id="datepicker" type="text" class="form-control mydatepicker" name="created" value="{{ date('d/m/Y') }}"
                                           required autofocus>

                                    @if ($errors->has('created'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('created') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('members') ? ' has-error' : '' }}">
                                <label for="users" class="col-md-4 control-label">Members</label>

                                <div class="col-md-6">
                                    @foreach ($members as $key => $member)
                                        <input type="checkbox"  value="{{$key}}" name="members[]"> {{$member}}<br>
                                    @endforeach

                                    @if ($errors->has('members'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('members') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>

                                    <a class="btn btn-link" href="{{ url('admin/roles') }}">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>    
@endsection
@section('scripts')
    <script>
        $(function(){  

            //jQuery('.mydatepicker, #datepicker').datepicker();
            $('#datepicker').datepicker({
                    format: 'dd/mm/yyyy',
            }).on('changeDate', function(e){
                $(this).datepicker('hide');
            });

        });
    </script>
@stop 