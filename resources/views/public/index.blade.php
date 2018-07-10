@extends("layouts.public")
@section("styles")
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
@endsection
@section("content")
  <div class="row">
    @include("include.public.slider",["sliders"=>$sliders])
    <div class="row">
      <div class="col-sm-3 " style="margin-top: 5rem; padding-left: 3rem;">
        <sidebar :sub_id="{!!request('sub',0)!!}" :sort="'{!!request('sort','latest')!!}'"></sidebar>
      </div>

      <div class="col-sm-9">
        @include('include.public.product.top',["products"=>$top_products])

      </div>
    </div>
    @include('include.public.product.featured',["products"=>$featured])



    @include('include.public.testimonial',["testimonials"=>$testimonials])
  </div>




@endsection


@section("scripts")
<script>

  new Vue({
      el:"#wrapper"
  });
$(document).ready(function(){
// invoke the carousel
  $('#myCarousel').carousel({
    interval:4000
  });
$("#myCarousel").on("touchstart", function(event){

      var yClick = event.originalEvent.touches[0].pageY;
    $(this).one("touchmove", function(event){

      var yMove = event.originalEvent.touches[0].pageY;
      if( Math.floor(yClick - yMove) > 1 ){
          $(".carousel").carousel('next');
      }
      else if( Math.floor(yClick - yMove) < -1 ){
          $(".carousel").carousel('prev');
      }
  });
  $(".carousel").on("touchend", function(){
          $(this).off("touchmove");
  });
});

});
//animated  carousel start
$(document).ready(function(){

//to add  start animation on load for first slide
$(function(){
  $.fn.extend({
    animateCss: function (animationName) {
      var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
      this.addClass('animated ' + animationName).one(animationEnd, function() {
        $(this).removeClass(animationName);
      });
    }
  });
     $('.item1.active img').animateCss('slideInDown');
     $('.item1.active h2').animateCss('zoomIn');
     $('.item1.active p').animateCss('fadeIn');

});

//to start animation on  mousescroll , click and swipe



   $("#myCarousel").on('slide.bs.carousel', function () {
  $.fn.extend({
    animateCss: function (animationName) {
      var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
      this.addClass('animated ' + animationName).one(animationEnd, function() {
        $(this).removeClass(animationName);
      });
    }
  });

// add animation type  from animate.css on the element which you want to animate
  //
  $('.item1 img').animateCss('slideInDown');
  $('.item1 h2').animateCss('zoomIn');
  $('.item1 p').animateCss('fadeIn');

  $('.item2 img').animateCss('zoomIn');
  $('.item2 h2').animateCss('swing');
  $('.item2 p').animateCss('fadeIn');

  $('.item3 img').animateCss('fadeInLeft');
  $('.item3 h2').animateCss('fadeInDown');
  $('.item3 p').animateCss('fadeIn');
  });
});

</script>
@endsection
