@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <a href="{{route("category.index")}}" class="btn btn-primary m-b-10" >All Category</a>
            <div class="white-box">


                <h3 class="page-header">New Category</h3>

                <form class="form-horizontal" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label">Category Name </label>

                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    {{--<div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">--}}
                        {{--<label for="file" class="col-md-2 control-label">Category Image </label>--}}

                        {{--<div class="col-md-10">--}}
                            {{--<input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" required autofocus>--}}

                            {{--@if ($errors->has('image'))--}}
                                {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('image') }}</strong>--}}
                                    {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>


                        </div>
                    </div>
                </form>
            </div>


            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}

        </div>



    </div>
@endsection
