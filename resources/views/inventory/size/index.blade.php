@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new size</button>

            <table class="table table-responsive white-box m-t-20" v-cloak>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="size in sizes">
                    <td>@{{ size.id }}</td>
                    <td>@{{ size.name }}</td>
                    <td><button class="btn btn-success" @click="editCategory(size.id,size.name)">Edit</button>
                        <button class="btn btn-danger" @click="deleteCategory(size.id)">Delete</button> </td>
                </tr>
                </tbody>
            </table>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Create Size</h4>
                        </div>
                        <form  method="post" action="{{route("size.store")}}">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" id=""  placeholder="Name" required="true" name="name">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                                <input type="submit" class="btn btn-success" value="Create">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="myUpdateModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Update size : @{{ sizeName }}</h4>
                        </div>
                        <form  method="post" :action="editUrl" >
                            {{csrf_field()}}
                            {{method_field("PUT")}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" id=""  placeholder="Name" required="true" name="name" :value="sizeName">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="myDeleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Delete size</h4>
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
                sizes:{!! json_encode($sizes) !!},
                editUrl:'',
                sizeName:'',
                deleteUrl:'',
            },
            methods:{
                editCategory:function (id,name) {
                    this.sizeName=name;
                    this.editUrl='/inventory/size/'+id;
                    $("#myUpdateModal").modal("show")

                },
                deleteCategory:function (id) {
                    this.deleteUrl='/inventory/size/'+id;
                    $("#myDeleteModal").modal("show");

                }
            }
        })
    </script>

@endsection