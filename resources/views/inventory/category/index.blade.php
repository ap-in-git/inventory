@extends("layouts.inventory")

@section("content")
    <div class="row" >

 <div class="col-md-12 ">

     <a href="{!! route("category.create") !!}" class="btn btn-primary">Add new category</a>
    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}

     <table class="table table-responsive white-box m-t-20" v-cloak>
         <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                {{--<th>Image</th>--}}
                <th>Action</th>
            </tr>
         </thead>
         <tbody>

           <tr v-for="category in categories">
               <td>#</td>
               <td>@{{ category.name }}</td>
               {{--<td><img :src="'/'+category.image" height="100" width="100"> </td>--}}
               <td><a class="btn btn-success" :href="'/inventory/category/'+category.id+'/edit'">Edit</a>
               <button class="btn btn-danger" @click.prevent="deleteCategory(category.id)">Delete</button> </td>
           </tr>

         </tbody>
     </table>

    <!-- Modal -->


     <div id="myDeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Category : @{{ categoryName }}</h4>
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
                categories:{!! json_encode($categories) !!},
                editUrl:'',
                categoryName:'',
                deleteUrl:'',
            },
            methods:{
                editCategory:function (id,name) {
                    this.categoryName=name;
                    this.editUrl='/inventory/category/'+id;
                 $("#myUpdateModal").modal("show")

               },
                deleteCategory:function (id) {
                    this.deleteUrl='/inventory/category/'+id;
                    $("#myDeleteModal").modal("show");

                }
            }
        })
    </script>

    @endsection