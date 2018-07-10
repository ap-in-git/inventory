@extends("layouts.inventory")

@section("content")
    <div class="row" >

        @foreach($errors->all() as $error)
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong>&nbsp; {{$error}}
                </div>
            </div>
        @endforeach

        <div class="col-md-12 ">

            <a href="{{route("stock.index")}}" class="btn btn-primary m-b-10" >All stocks</a>
            <div class="white-box">


                <h3 class="page-header">Edit Stock of product : {{$stock->product->name }} <small>({{$stock->size->name}} Size)</small> </h3>


            <form class="form-horizontal" method="POST" action="{{ route('stock.update',$stock->id) }}">
                {{ csrf_field() }}
                {{ method_field("PUT") }}
                <div class="form-group">
                    <label for="category" class="col-md-2 control-label">Category </label>

                    <div class="col-md-10">
                        <select name="category" class="form-control" id="category" v-model="categoryId" @change="changeSubCategory()">
                            <option :value="0">Select a category</option>
                            <option v-for="category in categories" :value="category.id"> @{{ category.name }}</option>
                        </select>


                    </div>
                </div>
                <div class="form-group">
                    <label for="subcategory" class="col-md-2 control-label">Subcategory </label>

                    <div class="col-md-10">
                        <select name="subcategory" class="form-control" id="category" v-model="subCategoryId" @change="changeProduct(false)">
                            <option :value="0">Select a subcategory</option>
                            <option v-for="category in subcategories" :value="category.id"> @{{ category.name }}</option>
                        </select>


                    </div>
                </div>

                <div class="form-group">
                    <label for="product" class="col-md-2 control-label">Product </label>

                    <div class="col-md-10">
                        <select name="product" class="form-control" id="product" v-model="defaultProduct" @change="changeCode()">
                            <option :value="0">Select a product</option>
                            <option v-for="product in products" :value="product.id"> @{{ product.name }}</option>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">HBW Name </label>

                    <div class="col-md-10">
                        <select name="user" class="form-control" id="user" v-model="defaultUser" @change="changeCode()">
                            <option v-for="user in users" :value="user.id">@{{ user.name }}</option>

                        </select>


                    </div>
                </div>

                <div class="form-group">
                    <label for="size" class="col-md-2 control-label">Size </label>

                    <div class="col-md-10">

                        <select name="size" class="form-control" id="size" v-model="defaultSize" @change="changeCode()">
                            <option :value="0">Select a size</option>

                            <option  v-for="size in sizes" :value="size.id">@{{ size.name }}</option>

                        </select>


                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">Code </label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" :value="code" disabled>
                        <input type="hidden" name="code" :value="code"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">Stock </label>

                    <div class="col-md-10">
                        <input type="number" class="form-control" value="{{$stock->quantity}}" name="quantity" disabled="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">Bought Price (NPR) </label>

                    <div class="col-md-10">
                        <input type="number" class="form-control" value="{{$stock->bought_price}}" name="bought_price">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">Selling Price (NPR)</label>

                    <div class="col-md-10">
                        <input type="number" class="form-control" value="{{$stock->price}}" name="price">
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>


                    </div>
                </div>
            </form>

        </div>
            <div class="white-box">


                <h3 class="page-header">Add/Remove  Stock of product : {{$stock->product->name }} <small>({{$stock->size->name}} Size)</small> </h3>


            <form class="form-horizontal" method="POST" action="{{ route('stock.insert',$stock->id) }}">
                {{ csrf_field() }}
                {{ method_field("PUT") }}
                <div class="form-group">
                    <label for="category" class="col-md-2 control-label">Category </label>

                    <div class="col-md-10">
                        <select name="category" class="form-control" id="category" disabled>
                            <option >{{$stock->product->category->name}}</option>

                        </select>


                    </div>
                </div>

                <div class="form-group">
                    <label for="product" class="col-md-2 control-label">Product </label>

                    <div class="col-md-10">
                        <select name="product" class="form-control" disabled>
                            <option>{{$stock->product->name}}</option>

                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">HBW Name </label>

                    <div class="col-md-10">
                        <select name="user" class="form-control" id="user" disabled >
                            @foreach($users as $user)
                                @if($stock->user_id==$user->id)
                                <option >{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>


                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">Code </label>

                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{$stock->code}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-md-2 control-label">Type</label>
                    <div class="col-md-10">
                        <select name="type" id="type" class="form-control">
                            <option value="1">Add</option>
                            <option value="0">Remove</option>
                            <option value="2">Product Return</option>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">Stock </label>

                    <div class="col-md-10">
                        <input type="number" class="form-control" value="" name="quantity" placeholder="Stock Amount" required >
                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">Bought Price (NPR)</label>

                    <div class="col-md-10">
                        <input type="number" class="form-control" value="" name="bought_price" placeholder="Brought Price" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-md-2 control-label">Notes </label>

                    <div class="col-md-10">
                        <textarea name="description" class="form-control" placeholder="Notes"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Update stock
                        </button>


                    </div>
                </div>
            </form>

        </div>




    </div>

    </div>
@endsection


@section("script")
    <script>
        new Vue({
            el:'#wrapper',
            data:{
                categories:{!! json_encode($categories) !!},
                categoryId:{!! $stock->product->category_id!!},
                subCategoryId:{!! $stock->product->subcategory_id !!},
                subcategories:[],
                products:[],
                defaultProduct:{!! $stock->product->id !!},
                users:{!! json_encode($users)!!},
                sizes:{!! json_encode($sizes) !!},
                defaultSize:{{$stock->size_id}},
                defaultUser:{{$stock->user_id}},
                code:'{{$stock->code}}',

            },
            methods:{
                changeProduct:function (type) {
                    if(this.subCategoryId===0)
                        return;
                    var self=this;

                      console.log(self.defaultProduct)
                    axios.get("/inventory/product?subcategory="+this.subCategoryId).then(function (response) {
                        self.products=response.data;
                        if(type==false)
                        self.defaultProduct=0;

                    })

                },
                changeSubCategory:function () {
                    if(this.categoryId===0)
                        return;
                    var self=this;
                    axios.get("/inventory/subcategory?category="+this.categoryId).then(function (response) {

                        self.subcategories=response.data;
                        self.subCategoryId=0;


                    })
                },
                findProductNameById:function (id) {
                    return this.products.find(item => item.id===this.defaultProduct).code;

                },
                findSizeNameById:function (id) {
                    return this.sizes.find(item => item.id===this.defaultSize).name;

                },
                changeCode:function () {
                    if(this.defaultProduct===0||this.defaultSize===0||this.defaultProduct===0)
                        return;

                    var name=this.findProductNameById(this.defaultProduct);
                    var size=this.findSizeNameById(this.defaultSize).substr(0,2);


                    this.code=name+"-"+size+"#"+this.defaultUser;



                }

            },
            mounted:function () {
                var self=this;
                axios.get("/inventory/subcategory?category="+this.categoryId).then(function (response) {
                    self.subcategories=response.data;
                    self.changeProduct(true);
                })
                {{--axios.get("/inventory/product?category="+this.categoryId).then(function (response) {--}}
                    {{--self.products=response.data;--}}
                    {{--self.defaultProduct={{$stock->product->id}};--}}

                {{--})--}}
            }
        })
    </script>

@endsection
