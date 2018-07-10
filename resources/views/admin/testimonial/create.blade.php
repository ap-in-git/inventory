@extends("layouts.inventory")
@section("content")
    <div class="row white-box m-t-20">
        <h2 class="page-header text-center">Add a new Testimonial</h2>
        <div class="col-sm-12">
            <form method="post" action="{{route("admin.testimonial.store")}}" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image" class="col-md-2 control-label">Profile Image </label>

                    <div class="col-md-10">
                        <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" required autofocus>

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
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                    <label for="company" class="col-md-2 control-label">Company</label>

                    <div class="col-md-10">
                        <input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" required autofocus>

                        @if ($errors->has('company'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                    <label for="position" class="col-md-2 control-label">Profile Position</label>

                    <div class="col-md-10">
                        <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" required autofocus>

                        @if ($errors->has('position'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <label for="text" class="col-md-2 control-label">Saying</label>

                    <div class="col-md-10">
                        <textarea class="form-control" name="text"></textarea>

                        @if ($errors->has('text'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-success pull-right" value="Create">
                </div>

            </form>
        </div>
    </div>
    @endsection