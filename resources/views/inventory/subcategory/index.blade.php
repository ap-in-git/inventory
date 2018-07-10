@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <a href="{{route("subcategory.create")}}" class="btn btn-primary" >Add a new subcategory</a>

            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}

            <table class="table table-responsive white-box m-t-20" v-cloak>
                <thead>
                <tr>
                    <th>#</th>

                    <th>Name</th>

                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="subcategory in subcategories">
                    <td>@{{ subcategory.id }}</td>
                    <td>@{{ subcategory.name }}</td>

                    <td>
                        <a class="btn btn-success"  :href="'/inventory/subcategory/'+subcategory.id+'/edit'" >Edit</a>
                        <button class="btn btn-danger" @click="deletesubcategory(subcategory.id)">Delete</button> </td>
                </tr>
                </tbody>
            </table>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Create Category</h4>
                        </div>
                        <form  method="post" action="{{route("category.store")}}" enctype="multipart/form-data">
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
                subcategories:{!! json_encode($subcategories) !!},
                editUrl:'',
                categoryName:'',
                deleteUrl:'',
            },
            methods:{
                editCategory:function (id,name) {
                    this.categoryName=name;
                    this.editUrl='/inventory/subcategory/'+id;
                    $("#myUpdateModal").modal("show")

                },
                deletesubcategory:function (id) {
                    this.deleteUrl='/inventory/subcategory/'+id;
                    $("#myDeleteModal").modal("show");

                }
            }
        })
    </script>

@endsection