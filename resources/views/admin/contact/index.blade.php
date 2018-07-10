@extends("layouts.inventory")
@section("content")
    <div class="row" >

        <div class="col-md-12 ">
            <h2 class="page-header">All Products message</h2>

            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}

            <table class="table table-responsive white-box m-t-20" v-cloak>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Seen</th>
                    <th>&nbsp;</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="message in messages">
                    <td>@{{ message.id }}</td>

                    <td>@{{ message.name }}</td>
                    <td>@{{ message.email }}</td>
                    <td>@{{ message.seen==1?'seen':'not seen'}}</td>
                    <td>
                        <button class="btn btn-primary" @click.prevent="viewMessage(message.id)">Message Details</button>
                        <button class="btn btn-danger" @click.prevent="deletemessage(message.id)">Delete message</button>
                    </td>
                </tr>

                </tbody>
            </table>


            <div id="myShowModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Message Details  </h4>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                             Name: @{{ currentMessage.name }}
                                        </li>
                                        <li class="list-group-item">
                                            Email: @{{ currentMessage.email }}
                                        </li>
                                        <li class="list-group-item">
                                            Phone: @{{ currentMessage.phone }}
                                        </li>

                                        <li class="list-group-item">
                                            Note: @{{ currentMessage.message }}
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
                messages:{!! json_encode($messages) !!},
                currentMessage:[],

                deleteUrl:'',
            },
            methods:{
                viewMessage:function (id) {
                    var self=this;
                    axios.get("/admin/message/"+id).then(function (response) {

                        self.currentMessage=response.data;

                        for(var i=0;i<self.messages.length;i++){
                            console.log(response.data)
                            if(self.messages[i].id==response.data.id){
                                self.messages[i].seen=1;
                            }
                        }
                    });

                    $("#myShowModal").modal("show")

                },
                deletemessage:function (id) {
                    this.deleteUrl='/admin/message/'+id;
                    $("#myDeleteModal").modal("show");

                }
            },
        })
    </script>

@endsection
