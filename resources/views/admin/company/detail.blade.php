@extends("layouts.inventory")
@section("content")
    <div class="row white-box m-t-20">
        <h2 class="page-header text-center">Company Details</h2>
        <div class="col-sm-12 m-b-10">
            <div id="map" style="width: 100%; height: 400px;">

            </div>
        </div>
        <div class="col-sm-8">
            <form method="post" action="{{route("admin.company.detail.store")}}" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Name</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $company_details->company_name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image" class="col-md-2 control-label">Logo </label>

                    <div class="col-md-10">
                        <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}"  autofocus>

                        @if ($errors->has('image'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-2 control-label">Email</label>

                    <div class="col-md-10">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $company_details->email }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label for="city" class="col-md-2 control-label">City</label>

                    <div class="col-md-10">
                        <input id="city" type="text" class="form-control" name="city" value="{{ $company_details->city }}" required autofocus>

                        @if ($errors->has('city'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
                    <label for="district" class="col-md-2 control-label">District</label>

                    <div class="col-md-10">
                        <input id="district" type="text" class="form-control" name="district" value="{{ $company_details->district }}" required autofocus>

                        @if ($errors->has('district'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-2 control-label">Phone Number</label>

                    <div class="col-md-10">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $company_details->phone_no }}" required autofocus>

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('cell') ? ' has-error' : '' }}">
                    <label for="cell" class="col-md-2 control-label">Cell Number</label>

                    <div class="col-md-10">
                        <input id="cell" type="text" class="form-control" name="cell" value="{{ $company_details->cell_no }}" required autofocus>

                        @if ($errors->has('cell'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('cell') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                    <label for="latitude" class="col-md-2 control-label">Latitude</label>

                    <div class="col-md-10">
                        <input id="latitude" type="text" class="form-control" name="latitude" value="{{ $company_details->latitude }}" required autofocus>

                        @if ($errors->has('latitude'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                    <label for="longitude" class="col-md-2 control-label">Longitude</label>

                    <div class="col-md-10">
                        <input id="longitude" type="text" class="form-control" name="longitude" value="{{ $company_details->longitude }}" required autofocus>

                        @if ($errors->has('longitude'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('fb_link') ? ' has-error' : '' }}">
                    <label for="fb_link" class="col-md-2 control-label">Facebook link</label>

                    <div class="col-md-10">
                        <input id="fb_link" type="text" class="form-control" name="fb_link" value="{{ $company_details->fb_link }}"  autofocus>

                        @if ($errors->has('fb_link'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('fb_link') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('twitter_link') ? ' has-error' : '' }}">
                    <label for="twitter_link" class="col-md-2 control-label">Twitter link</label>

                    <div class="col-md-10">
                        <input id="twitter_link" type="text" class="form-control" name="twitter_link" value="{{ $company_details->twitter_link }}"  autofocus>

                        @if ($errors->has('twitter_link'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('twitter_link') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('linkedin_link') ? ' has-error' : '' }}">
                    <label for="linkedin_link" class="col-md-2 control-label">LinkedIn Link</label>

                    <div class="col-md-10">
                        <input id="linkedin_link" type="text" class="form-control" name="linkedin_link" value="{{ $company_details->linked_in_link }}"  autofocus>

                        @if ($errors->has('linkedin_link'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('linkedin_link') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('short_detail') ? ' has-error' : '' }}">
                    <label for="short_detail" class="col-md-2 control-label">Short Detail</label>

                    <div class="col-md-10">
                        <textarea class="form-control" name="short_detail" id="short_detail" required>{!! $company_details->short_detail !!}</textarea>

                        @if ($errors->has('short_detail'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('short_detail') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-success pull-right" value="update">
                </div>

            </form>
        </div>
        <div class="col-sm-4">
            <h4>Logo</h4>
            <img src="{{asset($company_details->logo_url)}}" alt="" class="img img-responsive">
            <h4>Map</h4>

        </div>
    </div>
@endsection
@section('script')
    <script>
        function initMap() {
            var uluru = {lat:{{$company_details->latitude}}, lng:{{$company_details->longitude}}};
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
