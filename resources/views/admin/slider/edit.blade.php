@extends("layouts.inventory")
@section("content")
    <div class="row white-box m-t-20">
        <h2 class="page-header text-center">Edit slider</h2>
        <div class="col-sm-6">
            <form method="post" action="{{route("admin.slider.update",$slider->id)}}" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field("put")}}
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image" class="col-md-2 control-label">Category Image </label>

                    <div class="col-md-10">
                        <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}"  autofocus>

                        @if ($errors->has('image'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-2 control-label">Name</label>

                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control" name="title" value="{{ $slider->name }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-success pull-right" value="update">
                </div>

            </form>
        </div>
        <div class="col-sm-6">
            <img src="{{asset("images/slider/".$slider->image_url)}}" class="img img-responsive">

        </div>
    </div>
@endsection