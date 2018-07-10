@extends("layouts.inventory")
@section("content")
    <div class="row" >
        <div class="col-md-12 ">

            <a href="{{route("product.index")}}" class="btn btn-primary m-b-10" >All products</a>
             <div class="white-box">


            <h3 class="page-header">New Product</h3>

                 <form class="form-horizontal" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                     {{ csrf_field() }}

                     <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                         <label for="category" class="col-md-2 control-label">Category </label>

                         <div class="col-md-10">
                             <select name="category" class="form-control" id="category" v-model="defaultCategory" @change="getSubCategory()">
                                 <option value="0">Select a category</option>
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

                             <select name="subcategory" class="form-control" id="subcategory" v-model="defaultSubcategory">
                                 <option :value="0">Select a subcategory</option>
                                 <option v-for="category in subcategories" :value="category.id">@{{ category.name }}</option>
                             </select>

                             @if ($errors->has('category'))
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
                                             <option value="{{$quality->id}}">{{$quality->name}}</option>
                                             @endforeach
                             </select>

                             @if ($errors->has('category'))
                                 <span class="help-block">
                                            <strong>{{ $errors->first('quality') }}</strong>
                                    </span>
                             @endif
                         </div>
                     </div>
                     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                         <label for="name" class="col-md-2 control-label">Product Name </label>

                         <div class="col-md-10">
                             <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                             <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

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
                             <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" required autofocus>

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
                             <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required autofocus>

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
                             <textarea class="form-control" name="description" id="description" maxlength="191"></textarea>

                             @if ($errors->has('description'))
                                 <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group">
                         <div class="col-md-8 col-md-offset-4">
                             <button type="submit" class="btn btn-primary" :disabled="defaultSubcategory==0">
                                 Create Product
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
            el:"#wrapper",
            data:{
                value: { language: 'JavaScript', library: 'Vue-Multiselect' },
                message:"hi",
                defaultCategory:0,
                categories:{!! json_encode($categories) !!},
                subcategories:[],
                defaultSubcategory:0,

            },
           methods:{
               getSubCategory:function () {
                   if(this.defaultCategory===0)
                       return;
                   var self=this;
                   axios.get("/inventory/subcategory?category="+this.defaultCategory).then(function (response) {
                       self.subcategories=response.data;
                   })
               }
           },
            mounted:function(){

            }

        });
    </script>
    @endsection
