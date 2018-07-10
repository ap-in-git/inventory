@extends("layouts.public")
@section("contact")
    <div class="jumbotron jumbotron-sm blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="h1">
                        Contact us <small>Feel free to contact us</small></h1>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section("content")
    <div class="col-sm-12 m-b-10">
        <div id="map" style="width: 100%; height: 400px;">

        </div>
    </div>
    <div class="col-md-8">
        <div class="well well-sm">
            <form method="post" action="/contact">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span>
                                </span>
                                <input type="email" class="form-control" name="phone" id="email" placeholder="Enter phone" required="required" /></div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                      placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <form>
            <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
            <address>
                <strong>{{$global_company_details->company_name}}</strong><br>
                {{$global_company_details->city.','.$global_company_details->district}},Nepal<br>

                <abbr title="Phone">
                    P:</abbr>
              {{$global_company_details->phone_no}}
            </address>
            <address>
                <a href="mailto:{{$global_company_details->email}}">{{$global_company_details->email}}</a>
            </address>
        </form>
    </div>

    @endsection
@section('scripts')
    <script>
        function initMap() {
            var uluru = {lat:{{$global_company_details->latitude}}, lng:{{$global_company_details->longitude}}};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK5VpjTCTxBrTUJL9ulTIbrpaWpGZEawA&callback=initMap">
    </script>
@endsection


