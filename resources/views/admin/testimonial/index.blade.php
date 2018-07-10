@extends("layouts.inventory")
@section("content")
    <div class="row">
        <div class="col-sm-12 m-t-5 m-b-5">
            <a href="{{route("admin.testimonial.create")}}" class="btn btn-primary">Add new testimonial</a>
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Profile Name</th>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($testimonials as $testimonial)
                    <tr>
                        <td>{{$testimonial->id}}</td>
                        <td>{{$testimonial->name}}</td>
                        <td>{{$testimonial->company}}</td>
                        <td>{{$testimonial->position}}</td>
                        <td><img src="{{asset($testimonial->image_url)}}" class="img img-responsive" height="200" width="200"> </td>
                        <td>
                            <a href="{{route("admin.testimonial.edit",$testimonial->id)}}" class="btn btn-success">Edit</a>
                            <a href="#" class="btn btn-danger" onclick="deleteSlider('{{$testimonial->id}}')">Delete</a>

                        </td>
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
                        <h4 class="modal-title">Delete testimonial</h4>
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
        function deleteSlider(id) {
            $("#deleteSlider").attr("action","/admin/testimonial/"+id);
            $("#myModal").modal("show")
        }
    </script>
@endsection