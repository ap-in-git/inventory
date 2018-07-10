@extends("layouts.public")

@section("contact")
    <div class="jumbotron jumbotron-sm blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="h1 text-center">
                        About  us</h1>
                    <h3 class="text-center">Know about us</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("content")
     <div>
         <h1 class="bold " id="companyOverview">Company overview</h1>
               {!! $global_company_details->company_overview !!}
     </div>
     <div id="coreValues">
         <h2 class="text-center">Core Values</h2>
              {!! $global_company_details->core_value !!}
     </div>
     <div>
         <h1 class="bold " id="companyLeaderShip">Company Leadership</h1>
         @foreach($workers as $worker)
         <div class="media media-profile">
             <div class="media-left">
                 <img src="{{asset($worker->image)}}" class="media-object" width="200">
             </div>
             <div class="media-body">
                 <h4 class="media-heading">{{$worker->name}}, {{$worker->position}}</h4>
                 <p>
                     {!! $worker->saying !!}
                 </p>
             </div>
         </div>

             @endforeach




     </div>

@endsection