@extends("layouts.inventory")
@section("content")
    <div class="row white-box m-t-20">
        <h2 class="page-header text-center">Edit profile</h2>
        <div class="col-sm-8">
            <form method="post" action="{{route("admin.worker.update",$worker->id)}}" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field("put")}}
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image" class="col-md-2 control-label">Profile Image </label>

                    <div class="col-md-10">
                        <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}"  autofocus>

                        @if ($errors->has('image'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Profile Name</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $worker->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                    <label for="position" class="col-md-2 control-label">Profile Position</label>

                    <div class="col-md-10">
                        <input id="position" type="text" class="form-control" name="position" value="{{ $worker->position }}" required autofocus>

                        @if ($errors->has('position'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('view_position') ? ' has-error' : '' }}">
                    <label for="view_position" class="col-md-2 control-label">View Position</label>

                    <div class="col-md-10">
                        <input id="view_position" type="number" class="form-control" name="view_position" value="{{ $worker->view_position }}" required autofocus>

                        @if ($errors->has('view_position'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('view_position') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('saying') ? ' has-error' : '' }}">
                    <label for="saying" class="col-md-2 control-label">Profile Saying</label>

                    <div class="col-md-10">
                        <textarea class="form-control" name="saying" required id="saying">{!! $worker->saying !!}</textarea>
                        @if ($errors->has('saying'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('saying') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-success pull-right" value="Update">
                </div>

            </form>
        </div>

        <div class="col-sm-4">
            <h4>Image</h4>
            <img src="{{asset($worker->image)}}" class="img img-responsive">
        </div>
    </div>
@endsection