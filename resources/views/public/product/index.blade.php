@extends('layouts.public')
@section('styles')

<style>
.m-t-10{
  margin-top: 20px;
}
</style>

@endsection
@section("contact")
    <div class="jumbotron jumbotron-sm black-background">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="h1 text-center bold">  Our Products </h1>

                </div>
            </div>
        </div>
    </div>
    @endsection
@section('content')
  <div class="row">
      <div class="col-sm-3">
        <sidebar :sub_id="{!!request('sub',0)!!}" :sort="'{!!request('sort','latest')!!}'"></sidebar>
      </div>
      <div class="col-sm-9">

      <div class="row">
        <div class="col-sm-12">
          <select  class="form-control" v-model='sort' @change='changeProduct()'>
          <label for="sort">Sort By</label>
            <option :value="'latest'">Latest</option>
            <option :value="'oldest'">Oldest</option>
            <option :value="'alpha_asc'">A-Z</option>
            <option :value="'alpha_desc'">Z-A</option>
          </select>
        </div>
      </div>
          <div class="row">
            @foreach ($products as $key => $product)
              <div class="col-sm-4 col-xs-6 m-t-10">
                <img src="{{asset($product->image)}}" alt="" class="img img-responsive">


                        <strong>Name : {{$product->name}}</strong>
                               <br>

                          <strong>Price : NPR {{$product->price}}</strong>



                    <a href="/product/{{$product->id}}" class="btn btn-success btn-block m-t-5">View Product</a>
              </div>


            @endforeach

            <div class="text-center">{{$products->appends([
              'sort'=>request('sort','latest'),
              'sub'=>request('sub',0)
              ])->links()}}</div>
          </div>
      </div>
  </div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el:"#wrapper",
            data:{
              sub:{!!request('sub',0)!!},
              sort:'{!!request('sort','latest')!!}'
            },
            methods:{
              changeProduct:function(){
                window.location.href="/products?sub="+this.sub+"&sort="+this.sort;
              }
            }
        })
    </script>
@endsection
