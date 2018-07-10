<section id="top">
  <h3 class="text-center section-title">Top product</h3>
  <div class="row m-t-10">

    @foreach($products as $product)
    <div class="col-sm-3 col-xs-6 ">
      <img src="{{$product->image}}" alt="" class="img img-responsive">
        <div class="row m-t-5 ">
          <div class="col-sm-6 col-xs-6">
             <strong>Name : {{$product->name}}</strong>
          </div>
          <div class="col-sm-6 col-xs-6">
             <strong>Price : NPR {{$product->price}}</strong>
          </div>
        </div>
          <a href="/product/{{$product->id}}" class="btn btn-success btn-block m-t-5">View Product</a>
    </div>

      @endforeach




  </div>

</section>
