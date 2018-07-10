@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <a href="{{route("stock.create")}}" class="btn btn-primary m-b-5" >Add stock</a>
            <div class="form-group" >
                <div class="input-group">
                    <input v-model="stockName" type="text" class="form-control" id="exampleInputuname" placeholder="Search stock by Name/Code" @keyup.enter="searchProduct()">
                    <div class="input-group-addon btn btn-default" @click="searchProduct()"><i class="ti-search" @click="searchProduct()"></i></div>
                </div>
            </div>
           {{--<div class="page-header">All stocks</div>--}}
            @if($stocks->count()>0)
                <div class="white-box m-t-">
                    <h2 class="page-header">
                        @if($has_query)
                            Search Result for : {{$query}}
                        @else
                            All stocks
                        @endif

                    </h2>
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Code </th>
                            <th>Item Price</th>
                            <th>Total Stock</th>
                            <th>&nbsp;</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{$stock->id}}</td>
                                <td>{{$stock->product->name}}</td>
                                <td>{{$stock->size->name}}</td>
                                <td>{{$stock->code}}</td>
                                <td>NPR.&nbsp;{{$stock->price}}</td>
                                <td>{{$stock->quantity}}</td>
                                <td>
                                    <a href="{{route("stock.edit",$stock->id)}}" class="btn btn-success">Edit</a>
                                    <a href="#" class="btn btn-danger" @click.prevent="deleteStock('{{$stock->id}}')">Delete</a>
                                    {{--<a href="#" class="btn btn-success">Edit</a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($has_query)
                        {{$stocks->appends(['query'=>$query])->links()}}
                    @else
                        {{$stocks->links()}}
                    @endif
                </div>
                @else
                <div class="white-box">
                    No result found
                </div>
                @endif


            {{--<div id="myDeleteModal" class="modal fade" role="dialog">--}}
                {{--<div class="modal-dialog">--}}
                    {{--<div class="modal-content">--}}

                        {{--<div class="modal-header">--}}
                            {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                            {{--<h4 class="modal-title" id="myModalLabel">Delete stock</h4>--}}
                        {{--</div>--}}
                        {{--<form  method="post" :action="deleteUrl" >--}}
                            {{--{{csrf_field()}}--}}
                            {{--{{method_field("Delete")}}--}}
                            {{--<div class="modal-body">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-12">--}}
                                        {{--You are on the delete track . This process is irreversible . Are you sure?--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="modal-footer">--}}
                                {{--<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>--}}
                                {{--<input type="submit" class="btn btn-danger" value="Delete">--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>



    </div>
@endsection

@section("script")
    <script>
        new Vue({
            el:'#wrapper',
            data:{
                deleteUrl:null,
                stockName:null,
            },
            methods:{

                deleteStock:function (id) {
                    console.log(id)
                    this.deleteUrl='/inventory/stock/'+id;
                    $("#myDeleteModal").modal("show");

                },
                searchProduct:function () {
                   if(this.stockName==null)
                       return;

                   window.location.href='/inventory/stock?query='+this.stockName
                }
            }
        })
    </script>

@endsection