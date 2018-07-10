@extends("layouts.inventory")
@section("styles")
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.6/dist/vue-multiselect.min.css">
@endsection
@section("content")
    <div class="row" >
              @foreach($errors->all() as $error)
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong>&nbsp;
                </div>
            </div>
                  @endforeach
        <div class="col-md-12 ">


            <a href="{{route("stock.index")}}" class="btn btn-primary m-b-10" >All stock</a>
            <div class="white-box">
               @foreach($errors->all() as $error)
                   {{$error}}
                   @endforeach
                <h3 class="page-header">Add a stock</h3>

                <form class="form-horizontal" method="POST" action="{{ route('stock.store') }}">
                    {{ csrf_field() }}

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
                            <select name="subcategory" class="form-control" id="subcategory" v-model="subcategoryId" @change="changeProduct()">
                                <option :value="0">Select a subcategory</option>
                                <option v-for="subcategory in subcategories" :value="subcategory.id"> @{{ subcategory.name }}</option>
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
                            <multiselect v-model="defaultUser" :options="users"  placeholder="Select one" label="name" track-by="id" @select="changeCode"></multiselect>
                            <input type="hidden" name="user" :value="defaultUser.id">


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
                        <label for="size" class="col-md-2 control-label">Code </label>

                        <div class="col-md-10">
                            <input type="text" class="form-control" :value="code" disabled="disabled"/>
                            <input type="hidden" :value="code" name="code">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-md-2 control-label">Bought Price (NPR)</label>

                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price">


                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-2 control-label">Selling Price (NPR)</label>

                        <div class="col-md-10">
                            <input type="text" class="form-control" name="selling_price">


                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-md-2 control-label">Stock </label>

                        <div class="col-md-10">
                            <input type="number" class="form-control" name="stock">
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" :disabled="!code">
                                Create stock
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
    <script src="https://unpkg.com/vue-multiselect@2.0.6"></script>

    <script>
new Vue({
el:'#wrapper',
    components: {
        Multiselect: window.VueMultiselect.default
    },
data:{
categories:{!! json_encode($categories) !!},
    categoryId:0,
    subcategoryId:0,
    products:[],
    users:{!! json_encode($users)!!},
    sizes:{!! json_encode($sizes) !!},
    subcategories:[],
    defaultSize:0,
    defaultUser:false,
    defaultProduct:0,
    code:null,

},
methods:{
    changeProduct:function () {
       if(this.categoryId===0)
           return;
       var self=this;

       axios.get("/inventory/product?subcategory="+this.subcategoryId).then(function (response) {
           self.products=response.data;
           self.defaultProduct=0;

       })

    },
    changeSubCategory:function () {
        if(this.categoryId===0)
            return;
        var self=this;
        axios.get("/inventory/subcategory?category="+this.categoryId).then(function (response) {

            self.subcategories=response.data;


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
        if(this.defaultUser){
            this.code=name+"-"+size+"#"+this.defaultUser.id;

        }



    }

}
})
</script>

@endsection