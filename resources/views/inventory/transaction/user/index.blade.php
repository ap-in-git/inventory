@extends("layouts.inventory")

@section("content")
    <div class="row" >

        <div class="col-md-12 ">

            <div class="form-group" >
                <div class="input-group">
                    <input v-model="userName" type="text" class="form-control" id="exampleInputuname" placeholder="Search User" @keyup.enter="searchUser()">
                    <div class="input-group-addon btn btn-default" @click="searchUser()"><i class="ti-search" @click="searchUser()"></i></div>
                </div>
            </div>

            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new Category</button>--}}
             <div class="white-box m-t-5">
                 @if($is_search)
                     <h2 class="page-header">Search result for {{$query}}</h2>
                 @else
                     <h2 class="page-header">All users</h2>
                     @endif
            <table class="table table-responsive m-t-5">

                <thead>
                <tr>
                    <th>#</th>

                    <th>HBW Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr >
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a class="btn btn-success"  href="/inventory/user-transaction/{{$user->id}}" >View transaction</a>

                </tr>
                    @endforeach
                </tbody>
            </table>


                     @if($is_search)
                         {{$users->appends(['query'=>$query])->links()}}
                     @else
                         {{$users->links()}}
                     @endif
             </div>
        </div>



    </div>
@endsection

@section("script")
    <script>
        new Vue({
            el:'#wrapper',
            data:{
                userName:null,
            },
            methods:{
                searchUser:function () {

                    if(this.userName===null)
                        return;

                    window.location.href='/inventory/user-transaction?query='+this.userName
                }
            }
        })
    </script>

@endsection