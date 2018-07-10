
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    {{--<link rel="icon" type="image/png" sizes="16x16" href="https://wrappixel.com/ampleadmin/ampleadmin-html/plugins/images/favicon.png">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $global_company_details->company_name }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{asset("css/sidebar-nav.min.css")}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset("css/animate.css")}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{asset("css/colors/default.css")}}" id="theme" rel="stylesheet">
    <style>
        v-cloak{
            display: none;
        }
    </style>
    @yield("styles")
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header" >
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">

            <!-- /Logo -->
            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left">
                <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>

                <!-- /.Megamenu -->
            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">

                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="blank.html#"> <b class="hidden-xs">{!! ucfirst(Auth::user()->name) !!}</b><span class="caret"></span> </a>

                    <ul class="dropdown-menu dropdown-user animated flipInY">

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <div class="navbar-default sidebar m-t-40" role="navigation">
        <div class="sidebar-nav slimscrollsidebar m-t-40">
            <ul class="nav" id="side-menu">
@include("include.sidebar")



            </ul>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid  ">

            @include("include.message")

            @yield("content")
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->

            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- /.container-fluid -->
        {{--<footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>--}}
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('js/sidebar-nav.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset("js/waves.js")}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset("js/custom.min.js")}}"></script>
<!--Style Switcher -->
<script src="{{asset("js/jQuery.style.switcher.js")}}"></script>

@yield("script")
</body>

</html>