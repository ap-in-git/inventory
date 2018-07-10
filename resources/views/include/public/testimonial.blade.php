<section id="testimonial">
  <h3 class="text-center section-title">See what our client say</h3>
  <div class="row p-l-10">
     @foreach($testimonials as $testimonial)
    <div class="col-sm-3">
      <div class="card">
        <img src="{{asset($testimonial->image_url)}}" alt="" class="img img-responsive">
          <p class="text-center">
              {{$testimonial->text}}
          </p>
         <div class="user-name">{{$testimonial->name}}</div>
         <div class="text-center designation">{{$testimonial->position}}, {{$testimonial->company}}</div>
      </div>

    </div>
      @endforeach




  </div>

</section>
