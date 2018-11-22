
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Arsip')</title>

    <link href="{{ asset('templates/inspinia_271/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">



    <link href="{{ asset('templates/inspinia_271/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/style.css') }}" rel="stylesheet">
    @yield('custom_css')

</head>

<body>

    <div id="wrapper">

        @include('layouts.partials.navbar_inspi')

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="{{ asset('templates/inspinia_271/#') }}"><i class="fa fa-bars"></i> </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        {{-- <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                        </li> --}}

                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                    
                </ul>

            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>@yield('page-title','page-title')</h2>

            </div>
            <div class="col-lg-2">

            </div>
        </div>


        <div class="wrapper wrapper-content animated fadeInRight">
            @yield('content')
        </div>
        <div class="footer" >
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

    </div>
</div>



<!-- Mainly scripts -->
<script src="{{ asset('templates/inspinia_271/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('templates/inspinia_271/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('templates/inspinia_271/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('templates/inspinia_271/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('templates/inspinia_271/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('templates/inspinia_271/js/plugins/pdfjs/pdf.js') }}"></script>
<script src="{{ asset('templates/inspinia_271/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/axios/dist/axios.min.js') }}"></script>




<!-- Custom and plugin javascript -->
<script src="{{ asset('templates/inspinia_271/js/inspinia.js') }}"></script>
<script src="{{ asset('templates/inspinia_271/js/plugins/pace/pace.min.js') }}"></script>


@yield('custom_js')

</body>

</html>
