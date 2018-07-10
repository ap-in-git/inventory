@extends('layouts.public')
@section('styles')
<link rel="stylesheet" type="text/css"  href="{{asset("css/easyzoom.css")}}">
<style>
.single-product-image{
  margin-top: 85px;
    margin-left:40px;
}
.related-product{
  font-weight: 400;
  font-size: 40px;
  text-align: center;

}
#relate-product-head{
  border-bottom: 3px solid black;
  margin-bottom: 20px;
}
.m-b-5{
    margin-bottom: 10px;
}

</style>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-5">
            <div class="easyzoom easyzoom--adjacent">
                <a href="{{asset($product->image)}}">
                    <img src="{{asset($product->image)}}" alt="" height="256" width="308" class="single-product-image" />
                </a>
            </div>

            {{--<img src="{{asset($product->image)}}" class="img img-responsive single-product-image" />--}}
        </div>
        <div class="col-sm-7" id="imageHoverDiv">
            <h2 class="bold page-header">{{$product->name}}</h2>
            <ul class="list-group">
             <li class="list-group-item"><label>Category :</label> {{optional($product->category)->name}}</li>
             <li class="list-group-item"><label>Subcategory :</label>{{optional($product->subcategory)->name}}</li>
             <li class="list-group-item"><label>Price :</label>NPR {{$product->price}}</li>
             <li class="list-group-item">
                 <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myOrderModal">OrderNow</button>

             </li>
             <li class="list-group-item"><label>Description</label>
                 <p>{!! $product->description !!}</p>

             </li>

           </ul>`
        </div>

        <div class="col-sm-12 text-center " id="relate-product-head">
            <span class="related-product">You might also like</span>
        </div>


          <!-- Modal -->
          <div id="myOrderModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Order Product</h4>
                      </div>
                      <form action="/product-order" method="post">
                          {{csrf_field()}}
                          <input type="hidden" name="id" value="{{$product->id}}"/>
                          <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control"  name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                              <div class="form-group">
                                <label for="note">Note</label>
                                  <textarea class="form-control" name="note" id="note"></textarea>
                                {{--<input type="text" class="form-control" id="quantity" name="quantity" required>--}}
                            </div>
                          </div>

                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" >Submit</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                      </form>

                  </div>

              </div>
          </div>

       <div class="col-sm-12 m-b-5">
         <div class="row">
                      @foreach($related_products as $product)
           <div class="col-sm-3 col-xs-6 ">
             <img src="{{asset($product->image)}}" alt="" class="img img-responsive" >
               <div class="row m-t-5 ">
                 <div class="col-sm-6 col-xs-6">
                    <strong>Name : {{$product->name}}</strong>
                 </div>
                 <div class="col-sm-6 col-xs-6">
                    <strong>Price : Rs {{$product->price}}</strong>
                 </div>
               </div>
                 <a href="/product/{{$product->id}}" class="btn btn-success btn-block m-t-5">View Product</a>
           </div>
                          @endforeach
         </div>
       </div>

      </div>

@endsection

@section('scripts')
    <script src="{{asset("js/easyzoom.js")}}"></script>
<script>
$(document).ready(function () {
    var $easyzoom = $('.easyzoom').easyZoom();
  $(".first-link").on("click",function(){
    var iconLink=$('.first-link').find(".first-icon")

     $(this).find(".first-icon").toggleClass("fa-minus");
  })
  $(".second-link").on("click",function(){
    $(this).find(".second-icon").toggleClass("fa-minus");
  })
       });


</script>

@endsection
