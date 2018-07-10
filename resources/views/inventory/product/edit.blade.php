@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <a href="{{route("product.index")}}" class="btn btn-primary m-b-10" >All products</a>
            <div class="white-box">


                <h3 class="page-header">Edit Product : {{$product->name}}</h3>

                <form class="form-horizontal" method="POST" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}

                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <label for="category" class="col-md-2 control-label">Category </label>

                        <div class="col-md-10">
                            <select name="category" class="form-control" id="category" @change="getSubCategory()" v-model="categoryId">
                                <option v-for="category in categories" :value="category.id">@{{ category.name }}</option>
                            </select>

                            @if ($errors->has('category'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('subcategory') ? ' has-error' : '' }}">
                        <label for="category" class="col-md-2 control-label">Subcategory </label>

                        <div class="col-md-10">
                            <select name="subcategory" class="form-control" id="category" v-model="defaultSubCategoryId">
                                <option value="0">Select a subcategory</option>
                                <option v-for="category in subcategories" :value="category.id">@{{ category.name }}</option>
                            </select>

                            @if ($errors->has('subcategory'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('subcategory') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('quality') ? ' has-error' : '' }}">
                        <label for="quality" class="col-md-2 control-label">Quality </label>

                        <div class="col-md-10">
                            <select name="quality" class="form-control" id="quality">
                                @foreach($qualities as $quality)
                                    <option value="{{$quality->id}}" {!! $product->status=$quality->id?'selected':' ' !!}>{{$quality->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('quality'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('quality') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label">Product Name </label>

                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control" name="name" value="{{$product->name}}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                        <label for="code" class="col-md-2 control-label">Code(Unique) </label>

                        <div class="col-md-10">
                            <input id="code" type="text" class="form-control" name="code" value="{{$product->code}}" required autofocus>

                            @if ($errors->has('code'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="col-md-2 control-label">Product Image </label>

                        <div class="col-md-10">
                            <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}"  autofocus>

                            @if ($errors->has('image'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-md-2 control-label">Product Price (Npr) :</label>

                        <div class="col-md-10">
                            <input id="price" type="number" class="form-control" name="price" value="{{ $product->price }}" required autofocus>

                            @if ($errors->has('price'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-2 control-label">Product Description </label>

                        <div class="col-md-10">
                            <textarea class="form-control" name="description" id="description" required>{{ $product->description }}</textarea>


                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update Product
                            </button>


                        </div>
                    </div>
                </form>
            </div>


            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}

        </div>



    </div>
@endsection
@section("script")
    <script>
        new Vue({
            el:'#wrapper',
            data:{
                categories:{!! json_encode($categories) !!},
                categoryId:{{$product->category_id}},
                products:[],
                defaultProduct:0,
                subcategories:[],
                defaultSubCategoryId:{{$product->subcategory_id}},


            },
            methods:{
                changeProduct:function () {
                    if(this.categoryId===0)
                        return;
                    var self=this;

                    axios.get("/inventory/product?category="+this.categoryId).then(function (response) {
                        self.products=response.data;
                        self.deleteProduct=0;

                    })

                },
                getSubCategory:function () {
                    console.log(this.categoryId)
                    if(this.categoryId===0)
                        return;
                    var self=this;
                    axios.get("/inventory/subcategory?category="+this.categoryId).then(function (response) {

                        self.subcategories=response.data;
                        self.defaultSubCategoryId=0;


                    })
                }

            },
            mounted:function(){
                var self=this;
                axios.get("/inventory/subcategory?category="+this.categoryId).then(function (response) {

                    self.subcategories=response.data;


                })
            }
        })
    </script>

@endsection