
<section id="footer-section">
<footer class="page-footer">
    <div style="background-color: #0277bd;">
      <div class="container">
        <div class="row p-t-b-4 d-flex">
          <div class="col-sm-6">
             <h6 class="text-center footer-h6">Get in touch with us</h6>
          </div>
          <div class="col-sm-4 col-sm-offset-2">
             <a href="{{$global_company_details->fb_link}}" target="_blank" class="icons-sm white-text"><i class="fa fa-facebook"></i></a>
             <a href="{{$global_company_details->twitter_link}}" target="_blank" class="icons-sm white-text"><i class="fa fa-twitter"></i></a>
             <a href="{{$global_company_details->linked_in_link}}" target="_blank" class="icons-sm white-text"><i class="fa fa-linkedin"></i></a>
             {{--<a href="#" class="icons-sm white-text"><i class="fa fa-instagram"></i></a>--}}
          </div>

        </div>
      </div>

    </div>

    <div class="container-fluid sub-footer">
      <div class="row m-t-5 m-b-5">
           <div class="col-sm-4">
             <h6 ><strong>{{$global_company_details->company_name}}</strong></h6>
             <hr class="footer-hr">
             <p>
              {!! $global_company_details->short_detail !!}
             </p>
           </div>

           <div class="col-sm-4">
             <h6 ><strong>Useful Links</strong></h6>
             <hr class="footer-hr">
             <p><a href="/">Home</a></p>
             <p><a href="/products">Products</a></p>
             <p><a href="/about">About</a></p>
             <p><a href="/contact">Contact</a></p>

           </div>

           <div class="col-sm-4">
             <h6 ><strong>Contact</strong></h6>
             <hr class="footer-hr">
             <p><i class="fa fa-home m-r-5"></i>  {{$global_company_details->city}},{{$global_company_details->district}} ,Nepal            </p>
             <p><i class="fa fa-envelope m-r-5"></i>  {{$global_company_details->email}}          </p>
             <p><i class="fa fa-phone m-r-5"></i>  {{$global_company_details->phone_no}}          </p>

           </div>

      </div>
    </div>

    <div class="footer-copyright">
     <div class="col-sm-6 text-center text-white">
       2017 &copy;Copyright.&nbsp;{{$global_company_details->company_name}}
     </div>
     <div class="col-sm-6 text-center text-white">
       Designed By :Ecare Digital solution
     </div>
    </div>
    <!-- /.container -->
</footer>
</section>
