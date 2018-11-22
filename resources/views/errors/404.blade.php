
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 Error</title>

    <link href="{{ asset('templates/inspinia_271/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('templates/inspinia_271/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>

        <div class="error-desc">
            <a class="btn btn-success waves-effect waves-light m-t-20" href="{{ url('/') }}"> Return Home</a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('templates/inspinia_271/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('templates/inspinia_271/js/bootstrap.min.js') }}"></script>

</body>

</html>
