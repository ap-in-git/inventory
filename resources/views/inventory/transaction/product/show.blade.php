@extends("layouts.inventory")

@section("content")
    <div class="row" >
        <div class="col-sm-9">

            <div class="white-box">
                <div class="row">
                  <div class="col-sm-7">
                      <label for="name">Search by code/HBW Name</label>

                      <input type="text" class="form-control  m-b-10" placeholder="Search record by Code/HBW Name" v-model="currentName" @keyup="getRecordByName()">
                  </div>
                    <div class="col-sm-5">
                        <label for="date">Filter By date</label>
                        <input type="date" class="form-control" v-model="currentDate" @change="filterByDate()">
                    </div>
                </div>

      <h4 class="box-title">All transaction of product : {{$product->name}}</h4>

                <table class="table  table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th>Size</th>
                        <th>Code</th>
                        <th>HBW Name</th>
                        <th>Bought price (NPR) </th>
                        <th>Quantity</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="transaction in transactions">
                        <td>@{{ transaction.size }}</td>
                        <td>@{{ transaction.code }}</td>
                        <td>@{{ transaction.user_name }}</td>
                        <td>@{{ transaction.price }}</td>
                        <td>@{{ transaction.quantity }}</td>
                        <td>@{{ transaction.created_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-sm-3">


            <div class="panel panel-info">
                <div class="panel-heading"> Product Details
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <img class="img img-responsive m-b-10" src="{{asset($product->image)}}">
                        <ul class="list-group">
                            <li class="list-group-item"><span>Name : </span>{{$product->name}}</li>
                            <li class="list-group-item"><span>Category : </span>{{$product->category->name}}</li>
                            <li class="list-group-item"><span>Subcategory : </span>{{$product->subcategory->name}}</li>
                            <li class="list-group-item"><span>Price (NPR) : </span>{{$product->price}}</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

@section("script")
    <script>
        new Vue({
            el:'#wrapper',
            data:{
              transactions:{!! json_encode($records)!!},
                currentName:null,
                backup_transactions:{!! json_encode($records)!!},
                currentDate:null,


            },
            methods:{
               getRecordByName:function () {
                   if(this.currentName==null||this.currentName=='')
                   {
                       this.transactions=this.backup_transactions;
                       return;
                   }

                   var self=this;

                   axios.get("/inventory/transaction/product-search?query="+this.currentName+"&id={{$product->id}}").then(function (response) {
                   self.transactions=response.data;
                   })
               },
                filterByDate:function () {
                   var self=this;
                  axios.get("/inventory/transaction/product-search?time="+this.currentDate+"&id={{$product->id}}").then(function (response) {
                      self.transactions=response.data;
                  })
                    
                }


            },
            mounted:function () {

            }
        })
    </script>

@endsection