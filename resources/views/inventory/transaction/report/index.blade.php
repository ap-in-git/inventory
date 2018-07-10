@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <div class="row">
                <div class="col-sm-6">
                    <label for="start">Start  Date</label>
                    <input type="date" class="form-control" v-model="TransactionStartDate" @change="getStockRecord()">
                </div>
                <div class="col-sm-6">
                    <label for="end">End Date</label>
                    <input type="date" class="form-control" v-model="TransactionEndDate" @change="getStockRecord()">
                </div>
            </div>


            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}
            <div class="white-box m-t-5">
                <div class="box-title">Stock Record from :&nbsp; @{{TransactionDateShow}} &nbsp; to &nbsp; @{{ TransactionDateEndShow }}</div>

                <table class="table table-responsive m-t-5">

                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>HBW Name</th>
                        <th>Code</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="record in records">
                        <td>@{{ record.product_name }}</td>
                        <td>@{{ record.size_name }}</td>
                        <td>@{{ record.user_name }}</td>
                        <td>@{{ record.code }}</td>
                        <td>@{{ record.quantity }}</td>
                        <td>@{{ record.code }}</td>
                        <td>@{{ record.created_at }}</Td>
                    </tr>
                    </tbody>
                </table>



            </div>
        </div>



    </div>
@endsection

@section("script")
    <script>
        new Vue({
            el:'#wrapper',
            data:{
                userName:null,
                TransactionDateShow:null,
                TransactionDateEndShow:null,
                TransactionStartDate:null,
                TransactionEndDate:null,
                records:{!! json_encode($records) !!}
            },
            methods:{
                getStockRecord:function () {
                    if(this.TransactionStartDate===null||this.TransactionEndDate===null)
                        return;


                   var self=this;
                   axios.get("/inventory/transaction/report?start="+this.TransactionStartDate+"&end="+this.TransactionEndDate).then(function (response) {
                       self.records=response.data;
                       self.TransactionDateShow=self.TransactionStartDate;
                       self.TransactionDateEndShow=self.TransactionEndDate;
                   })
                }
            },
            mounted:function () {

                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!

                var yyyy = today.getFullYear();
                if(dd<10){
                    dd='0'+dd;
                }
                if(mm<10){
                    mm='0'+mm;
                }
                var today = yyyy+'-'+mm+'-'+dd;
               this.TransactionDateShow=today;
               this.TransactionDateEndShow=today;

            }

        })
    </script>

@endsection