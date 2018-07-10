@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            {{--<sell-table></sell-table>--}}
            <div class="form-group" >
                <div class="input-group">
                    <input v-model="stockName" type="text" class="form-control" id="exampleInputuname" placeholder="Search transaction history by Bill No/Code/Product Name" @keyup.enter="searchProduct()">
                    <div class="input-group-addon btn btn-default" @click="searchProduct()"><i class="ti-search" @click="searchProduct()"></i></div>
                </div>
            </div>
            @if($transactions->count()>0)
                <div class="white-box m-t-10">
                    <h2 class="page-header">
                        @if($has_query)
                            Search Result for : {{$query}}
                        @else
                            All transaction history
                        @endif
                    </h2>
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Size </th>
                            <th>Quantity</th>
                            <th>Bought Price</th>
                            <th>Sold Price</th>
                            <th>Total Price</th>
                            <th>Bill No</th>
                            <th>Bought From</th>
                            <th>&nbsp;Created Date</th>
                            <th>&nbsp;</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->code}}</td>
                                <td>{{$transaction->product_name}}</td>
                                <td>{{$transaction->size}}</td>
                                <td>{{$transaction->quantity}}</td>
                                <td>NPR.&nbsp;{{$transaction->bought_price}}</td>
                                <td>NPR.&nbsp;{{$transaction->sold_price}}</td>
                                <td>NPR.&nbsp;{!! $transaction->sold_price*$transaction->quantity !!}</td>
                                <td>{{$transaction->bill_no}}</td>
                                <td>{{$transaction->user_name}}</td>
                                <td>{!! date("Y-m-d",strtotime($transaction->created_at)) !!}</td>
                                <td>
                                    @if($transaction->void==0)
                                        <a href="{!! route("transaction.cancel",$transaction->id) !!}" class="btn btn-danger" onclick="return confirm('Are you sure to cancel the bill?')">Cancel bill</a>
                                    @else
                                        <button class="btn btn-danger" type="button" disabled>Cancelled</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($has_query)
                        {{$transactions->appends(['query'=>$query])->links()}}
                    @else
                        {{$transactions->links()}}
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
                stockName:null
            },
            methods:{
//
//                deleteStock:function (id) {
//                    console.log(id)
//                    this.deleteUrl='/inventory/stock/'+id;
//                    $("#myDeleteModal").modal("show");
//
//                },
               searchProduct:function () {

                   if(this.stockName==null)
                       return;

                   window.location.href='/inventory/sell-history?query='+this.stockName
               }
            }
        })
    </script>

@endsection
