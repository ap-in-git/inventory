@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">
            <div class="form-group" >
                <div class="input-group">
                    <input v-model="stockName" type="text" class="form-control" id="exampleInputuname" placeholder="Search stock history by Name/Code/Person" @keyup.enter="searchProduct()">
                    <div class="input-group-addon btn btn-default" @click="searchProduct()"><i class="ti-search" @click="searchProduct()"></i></div>
                </div>
            </div>
            {{--<div class="page-header">All stocks</div>--}}
            @if($stocks->count()>0)
            <div class="white-box m-t-10">
                <h2 class="page-header">
                    @if($has_query)
                        Search Result for : {{$query}}
                    @else
                        All stocks history
                    @endif

                </h2>
                <table class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Code </th>
                        <th>Bought From</th>
                        <th> Price</th>
                        <th> Stock</th>
                        <th>Type</th>
                        <th>&nbsp;Created Date</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td>{{$stock->id}}</td>
                            <td>{{$stock->product_name}}</td>
                            <td>{{$stock->size_name}}</td>
                            <td>{{$stock->code}}</td>
                            <td>{{$stock->user_name}}</td>
                            <td>NPR .{{$stock->bought_price}}</td>
                            <td>{{$stock->quantity}}</td>
                            <td>
                                @if($stock->type==0)
                                    Removed
                                    @elseif($stock->type==1)
                                    Added
                                @else
                                    Product return

                                @endif
                            </td>
                            <td>{!! date("Y-m-d",strtotime($stock->created_at)) !!}</td>
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

                    window.location.href='/inventory/stock-history?query='+this.stockName
                }
            }
        })
    </script>

@endsection