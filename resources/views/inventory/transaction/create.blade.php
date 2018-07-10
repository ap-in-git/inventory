@extends("layouts.inventory")

@section("content")
    <div class="row" >
        <div class="col-sm-12 " v-if="successMsg">
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong>&nbsp; Item has been sold
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <div class="input-group">
                    <input v-model="stockName" type="text" class="form-control" id="exampleInputuname" placeholder="Search stock by Name/Code">
                    <div class="input-group-addon btn btn-default" @click="searchProduct()"><i class="ti-search" @click="searchProduct()"></i></div>
                </div>
            </div>

            <div class="white-box" v-if="hasStock">
                <table class="table table-responsive">
                    <thead>
                     <tr>
                        <th>#</th>
                         <th>Code</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Selling Price</th>
                         <th>Action</th>
                     </tr>
                    </thead>
                    <tbody>
                    <tr v-for="stock in stocks">
                        <td>@{{ stock.id }}</td>
                        <td>@{{ stock.code }}</td>
                        <td>@{{ stock.name }}</td>
                        <td>@{{ stock.size }}</td>
                        <td>@{{ stock.quantity }}</td>
                        <td> NPR.&nbsp;  @{{ stock.price }}</td>
                        <td><a href="#" class="btn btn-success  " @click.prevent="sellItem(stock.id)">Sell</a> </td>
                    </tr>

                    </tbody>
                </table>

            </div>

        </div>
         <div class="col-sm-12">
             <div id="mySellingModal" class="modal fade" role="dialog" >
                 <div class="modal-dialog">
                     <div class="modal-content">

                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title" id="myModalLabel">Sell item</h4>
                         </div>

                             <div class="modal-body">
                                 <div class="row">
                                         <div class="col-sm-12" v-if="hasError">
                                             <div class="alert alert-info alert-dismissable">
                                                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                 <strong>Error!</strong>&nbsp; @{{ errorMsg }}
                                             </div>
                                         </div>

                                     <div class="form-group m-b-5">
                                         <label for="name" class="col-md-4 control-label">Product Name </label>

                                         <div class="col-md-8">
                                             <input id="name" type="text" class="form-control" :value="currentStock.name"  disabled>
                                         </div>
                                     </div>
                                     <div class="form-group m-b-5">
                                         <label for="size" class="col-md-4 control-label">Product Size </label>

                                         <div class="col-md-8">
                                             <input id="size" type="text" class="form-control" :value="currentStock.size"  disabled>
                                         </div>
                                     </div>
                                     <div class="form-group m-b-5">
                                         <label for="quantity" class="col-md-4 control-label">Bill No </label>

                                         <div class="col-md-8">
                                             <input id="quantity" type="text" class="form-control" v-model="billNo" >
                                         </div>
                                     </div>
                                     <div class="form-group m-b-5">
                                         <label for="price" class="col-md-4 control-label">Product price . (NPR) </label>

                                         <div class="col-md-8">
                                             <input id="price" type="text" class="form-control" v-model="currentPrice"  >
                                         </div>
                                     </div>

                                     <div class="form-group m-b-5">
                                         <label for="quantity" class="col-md-4 control-label">Quantity </label>

                                         <div class="col-md-8">
                                             <input id="quantity" type="text" class="form-control" v-model="currentQuantity" >
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                                 <input type="button" class="btn btn-success" value="Sell" @click.prevent="finalSellItem()">
                             </div>
                         </form>
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
                stocks:[],
                hasStock:false,
                stockName:null,
                currentStock:[],
                currentPrice:null,
                currentQuantity:null,
                errorMsg:null,
                hasError:false,
                successMsg:false,
                billNo:null
            },
            methods:{
                searchProduct:function () {
                  if(this.stockName==null)
                      return;
                var self=this;

                  axios.get("/inventory/stock?query="+this.stockName).then(function (response) {
                    self.stocks=response.data;
                    self.hasStock=true;

                  })
                },
                sellItem:function (id) {
                    var self=this;
                    axios.get("/inventory/stock/"+id).then(function (response) {
                        self.currentStock=response.data;
                        self.currentPrice=self.currentStock.price;
                    })

                  $("#mySellingModal").modal("show")
                },
                finalSellItem:function () {

                    if(this.currentPrice==''||this.currentPrice=='')
                    {
                        this.hasError=true;
                        this.errorMsg="Price is required";
                        return;
                    }
                     if(this.currentQuantity==null||this.currentQuantity==''){
                         this.hasError=true;
                        this.errorMsg='Quantity is required'
                     }
                     if(this.billNo==null||this.billNo==''){
                         this.hasError=true;
                        this.errorMsg='Buyer name is required'
                     }
                     var self=this;
                     var currentStock=self.currentStock;
                    axios.get("/inventory/stock/"+currentStock.id).then(function (response) {
                        var stock=response.data;
                        if(self.currentQuantity>stock.quantity){
                            self.hasError=true;
                            self.errorMsg='Stock is not available'
                            return;
                        }

                        axios.post("/inventory/transaction",{
                            stock_id:currentStock.id,
                            price:self.currentPrice,
                            quantity:self.currentQuantity,
                            billNo:self.billNo
                        }).then(function (response) {
                          var stock_id=response.data[0];
                         for(i=0;i<self.stocks.length;i++){
                             if(self.stocks[i].id==stock_id){
                                 self.stocks[i].quantity=response.data[1];
                             }
                         }
                         $("#mySellingModal").modal("hide")
                         self.successMsg=true;

                            setTimeout(function () {
                                self.successMsg=false;
                            },3000)
                        }).catch(function (error) {
                            var message=error.response.data.errors.billNo[0];
                            self.hasError=true;
                            self.errorMsg=message;
                            return;
                        })
                    })



                }


            },
            watch:{
                stockName:function (oldVal,newVal) {
                    this.searchProduct()

                }
            }
        })
    </script>

@endsection