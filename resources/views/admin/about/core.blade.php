@extends("layouts.inventory")
@section("styles")
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
@endsection

@section("content")
    <div class="row">
        <div class="col-sm-12 m-t-20">
            <form action="{{route("admin.core.store")}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <textarea id="summernote" name="note">{{$global_company_details->core_value}}</textarea>

                <input type="submit" value="update" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection


@section("script")
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });
    </script>
@endsection

