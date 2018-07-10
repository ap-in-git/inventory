@extends("layouts.public")

@section("content")
    <h3 class="page-header text-center">Search result for : {!! request('q') !!}  <small><span class="label label-primary">{{$products->total()}} products</span></small></h3>
    <div class="col-sm-12">
        <div class="row">

            @foreach($products as $product)
                <div class="col-sm-4">
                    <div class="card">
                        <img src="{{$product->image}}" alt="Avatar" style="width:100%">
                        <h4 class="text-center"><b>{{$product->name}}</b></h4>
                        <p class="text-center">Rs. {{$product->price}}</p>
                        <div class="card-footer">
                            <a href="/product/{{$product->id}}" class="btn btn-success btn-block">View product</a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="text-center">{{$products->links()}}</div>
    </div>


@endsection
