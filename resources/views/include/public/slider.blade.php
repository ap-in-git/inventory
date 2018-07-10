<section class="slide-wrapper">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($sliders as $key=>$slider)
            <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$key==0?'active':''}}"></li>
            @endforeach
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
               @foreach($sliders as $key=>$slider)
            <div class="item {!! $key==0?'active':'' !!}">
                    <img src="{{asset("images/slider/".$slider->image_url)}}" alt="Los Angeles" style="width:100%; height:75vh; ">
                <div class="carousel-caption">
                    <h3>{{$slider->name}}</h3>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
  </section>
