@extends("layouts.inventory")

@section("content")
    <div class="row" >
        <div class="col-sm-8">
            <div class="white-box">
                <div class="alert alert-success alert-dismissable m-t-5"  v-if="successMsg" >
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong>&nbsp;Transaction added successfully
                </div>
                <h3 class="page-header">
                    All Transaction History For this HBW name <button class="btn btn-primary pull-right" @click.prevent="addTransaction=true">Add transaction</button>
                </h3>

                <div class="panel panel-info" v-if="addTransaction">
                    <div class="panel-heading"> Add transaction
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">

                            <div class="alert alert-danger alert-dismissable m-t-5"  v-if="errorMessage!=null">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error!</strong>&nbsp;@{{ errorMessage }}
                        </div>
                        <div class="panel-body bg-extralight">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" v-model="type">
                                    <option value="paid">Paid </option>
                                    <option value="due">Due</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Amount</label>
                                <input type="number" class="form-control" v-model="amount">
                            </div>
                            <div class="form-group" >
                                <label for="note">Note</label>
                                <textarea class="form-control" v-model="note"></textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" @click.prevent="beginTransaction()">Add transaction</button>
                                <button class="btn btn-danger pull-right" @click.prevent="addTransaction=false">Cancel</button>
                            </div>

                        </div>
                    </div>
                </div>

               <table class="table table-responsive table-striped table-hover">
                   <thead>
                   <tr>
                       <th>#</th>
                       <th>Type</th>
                       <th>Amount</th>
                       <th>Note</th>
                       <th>Transaction Date</th>
                   </tr>
                   </thead>
                   <tbody>
                   <tr v-for="transaction in transactions">
                       <td>@{{ transaction.id }}</td>
                       <td>@{{ transaction.type }}</td>
                       <td>@{{ transaction.amount }}</td>
                       <td>@{{ transaction.note }}</td>
                       <td>@{{ transaction.created }}</td>
                   </tr>

                   </tbody>
               </table>
                <h3 class="page-header">
                    All Selling Transaction History For this HBW name
                </h3>
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Bill No</th>
                            <th>Product Name</th>
                            <th>Quantity</th>

                            <th>Amount</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($user_sell_transactions as $transaction)
                      <tr>
                          <td>  {{$transaction->bill_no}}</td>


                          <td>{{$transaction->product_name}}</td>
                          <td>{{$transaction->quantity}}</td>

                          <td>Rs . {{$transaction->quantity*$transaction->sold_price}}</td>
                          <td>{{date("Y - m - d",strtotime($transaction->created_at)) }}</td>
                      </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
        <div class="col-sm-4">

            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}

            <div class="panel panel-info">
                <div class="panel-heading"> Hbw Name Details
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Name :</b> {{$user->name}}</li>
                            <li class="list-group-item"><b>Email :</b> {{$user->email}} </li>
                            <li class="list-group-item"><b>Created :</b> {!! $user->created_at->diffForHumans() !!}   </li>
                            <li class="list-group-item"><b>Total Due Till now :</b> @{{ total_due }}   </li>
                            <li class="list-group-item"><b>Total Paid Till now :</b> @{{ total_paid }}   </li>
                            <li class="list-group-item"><b>Remaining Amount to  be paid :</b> @{{ total_due-total_paid }}   </li>

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
               addTransaction:false,
                type:'paid',
                amount:null,
                note:null,
                errorMessage:null,
                transactions:{!! json_encode($transactions) !!},
                successMsg:false,
                total_paid:{!! $total_paid !!},
                    total_due:{!! $total_due !!}

            },
            methods:{
                beginTransaction:function () {
                    if(this.amount==null){
                        this.errorMessage='Amount is required'
                        return;
                    }
                    if(this.note==null){
                        this.errorMessage='Note is required'
                        return;
                    }
                    var self=this;
                    axios.post('/inventory/user-transaction',{
                        user_id:{!! $user->id !!},
                        amount:this.amount,
                        type:this.type,
                        note:this.note
                        
                    }).then(function (response) {
                        if(response.data.type==='paid'){
                          self.total_paid=self.total_paid+parseInt(response.data.amount);

                        }else{
                            self.total_due=self.total_paid+parseInt(response.data.amount);
                        }
                        self.transactions.unshift(response.data)
                        self.amount=null;
                        self.type=null;
                        self.note=null;
                        self.addTransaction=false;
                        self.successMsg=true;
                        setTimeout(function () {
                            self.successMsg=false;
                        },4000)
                    })

                }


            }
        })
    </script>

@endsection