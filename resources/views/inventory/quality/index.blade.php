@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new quality</button>

            <table class="table table-responsive white-box m-t-20" v-cloak>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="quality in qualities">
                    <td>@{{ quality.id }}</td>
                    <td>@{{ quality.name }}</td>
                    <td>@{{ quality.code }}</td>
                    <td>
                        <button class="btn btn-success" @click="editCategory(quality.id,quality.name,quality.code)">Edit</button>
                        </td>
                </tr>
                </tbody>
            </table>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Create quality</h4>
                        </div>
                        <form  method="post" action="{{route("quality.store")}}">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" id=""  placeholder="Name" required="true" name="name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Code(Unique)</label>
                                            <input type="text" class="form-control" id=""  placeholder="Code" required="true" name="code">
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
                            <h4 class="modal-title" id="myModalLabel">Update quality : @{{ qualityName }}</h4>
                        </div>
                        <form  method="post" :action="editUrl" >
                            {{csrf_field()}}
                            {{method_field("PUT")}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" id=""  placeholder="Name" required="true" name="name" :value="qualityName">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Code</label>
                                            <input type="text" class="form-control" id=""  placeholder="Name" required="true" name="code" :value="qualityCode">
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
                            <h4 class="modal-title" id="myModalLabel">Delete quality</h4>
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
                qualities:{!! json_encode($qualities) !!},
                editUrl:'',
                qualityName:'',
                qualityCode:'',
                deleteUrl:'',
            },
            methods:{
                editCategory:function (id,name,code) {
                    this.qualityName=name;
                    this.editUrl='/inventory/quality/'+id;
                    this.qualityCode=code;
                    $("#myUpdateModal").modal("show")

                },
                deleteCategory:function (id) {
                    this.deleteUrl='/inventory/quality/'+id;
                    $("#myDeleteModal").modal("show");

                }
            }
        })
    </script>

@endsection