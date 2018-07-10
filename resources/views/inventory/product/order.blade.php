@extends("layouts.inventory")
@section("content")
    <div class="row" >

        <div class="col-md-12 ">
            <h2 class="page-header">All Products Order</h2>

            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}

            <table class="table table-responsive white-box m-t-20" v-cloak>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Ordered By</th>
                    <th>Ordered  By  Email</th>
                    <th>Seen</th>
                    <th>&nbsp;</th>

                </tr>
                </thead>
                <tbody>
               <tr v-for="order in orders">
                   <td>@{{ order.id }}</td>
                   <td>@{{ order.product.name }}</td>
                   <td>@{{ order.name }}</td>
                   <td>@{{ order.email }}</td>
                   <td>@{{ order.seen==1?'seen':'not seen'}}</td>
                   <td>
                       <button class="btn btn-primary" @click.prevent="viewProduct(order.id)">View Order</button>
                       <a :href="'/admin/send-mail?email='+order.email" class="btn btn-success">Send email</a>
                       <button class="btn btn-danger" @click.prevent="deleteOrder(order.id)">Delete Order</button>
                   </td>
               </tr>

                </tbody>
            </table>
            
           
            <div id="myShowModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Order Details :@{{ currentOrder.product_name }} </h4>
                        </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                Product Name: @{{ currentOrder.product_name }}
                                            </li>
                                            <li class="list-group-item">
                                                Sent  By: @{{ currentOrder.name }}
                                            </li>
                                            <li class="list-group-item">
                                                Email: @{{ currentOrder.email }}
                                            </li>
                                            <li class="list-group-item">
                                                Phone: @{{ currentOrder.phone }}
                                            </li>
                                            <li class="list-group-item">
                                                Quantity: @{{ currentOrder.quantity }}
                                            </li>
                                            <li class="list-group-item">
                                                Note: @{{ currentOrder.note }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>

                            </div>

                    </div>
                </div>
            </div>
            <div id="myDeleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Delete  </h4>
                        </div>
                        <form  method="post" :action="deleteUrl" >
                            {{csrf_field()}}
                            {{method_field("Delete")}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        You are on the delete track . This process is irreversible . Are you sure?
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                                <input type="submit" class="btn btn-danger" value="Delete">
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
                orders:{!! json_encode($orders->Items()) !!},
                currentOrder:[],

                deleteUrl:'',
            },
            methods:{
                viewProduct:function (id) {
                    var self=this;
                     axios.get("/inventory/product-order/"+id).then(function (response) {

                       self.currentOrder=response.data;

                       for(var i=0;i<self.orders.length;i++){
                           console.log(response.data)
                           if(self.orders[i].id==response.data.id){
                               self.orders[i].seen=1;
                           }
                       }
                     });

                    $("#myShowModal").modal("show")

                },
                deleteOrder:function (id) {
                    this.deleteUrl='/inventory/order/'+id;
                    $("#myDeleteModal").modal("show");

                }
            },
            mounted:function () {
            }
        })
    </script>

@endsection
