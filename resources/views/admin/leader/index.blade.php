@extends("layouts.inventory")
@section("content")
    <div class="row">
        <div class="col-sm-12 m-t-5 m-b-5">
            <a href="{{route("admin.worker.create")}}" class="btn btn-primary">Add new worker</a>
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>View position</th>
                    <th>Image</th>
                    <th>Saying</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workers as $worker)
                    <tr>
                        <td>{{$worker->id}}</td>
                        <td>{{$worker->name}}</td>
                        <td>{{$worker->position}}</td>
                        <td>{{$worker->view_position}}</td>
                        <td><img src="{{asset($worker->image)}}" class="img img-responsive"> </td>
                        <td>{!!  $worker->saying!!}</td>
                        <td><a href="{{route("admin.worker.edit",$worker->id)}}" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger" onclick="deleteWorker('{{$worker->id}}')">Delete</a> </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete worker profile</h4>
                    </div>
                    <div class="modal-body">
                        <p>You are on the delete track this process is irreversible. Are you sure? </p>
                    </div>
                    <div class="modal-footer">
                        <form action="#" id="deleteSlider"  method="post">
                            {{csrf_field()}}
                            {{method_field("delete")}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        function deleteWorker(id) {
            $("#deleteSlider").attr("action","/admin/worker/"+id);
            $("#myModal").modal("show")
        }
    </script>
@endsection
