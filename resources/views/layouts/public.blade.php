
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! $global_company_details->company_name !!}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@yield("styles")
</head>

<body>
@include("include.public.topbar")
@yield("contact")
  <div class="container-fluid" id="wrapper">
      @include("include.message")

          @yield("content")


  </div>

{{--@yield("core")--}}

<!-- Footer -->
@include('include.public.footer')
<!-- Bootstrap core JavaScript -->
<script src="{{asset("js/app.js")}}"></script>
@yield("scripts")

</body>

</html>
