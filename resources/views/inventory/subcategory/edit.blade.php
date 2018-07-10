@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <a href="{{route("subcategory.index")}}" class="btn btn-primary m-b-10" >All subcategories</a>
            <div class="white-box">


                <h3 class="page-header">Update subcategory</h3>

                <form class="form-horizontal" method="POST" action="{{ route('subcategory.update',$subcategory->id) }}" >
                    {{ csrf_field() }}
                    {{method_field("PUT")}}

                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <label for="category" class="col-md-2 control-label">Category </label>

                        <div class="col-md-10">
                            <select name="category" class="form-control" id="category">
                                <option value="0">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {!! $category->id==$subcategory->category_id?'selected':''!!}>{{$category->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('category'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label"> Name </label>

                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $subcategory->name }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update subcategory
                            </button>


                        </div>
                    </div>
                </form>
            </div>


            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}

        </div>



    </div>
@endsection
