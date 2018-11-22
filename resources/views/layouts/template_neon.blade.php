<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />
    <link rel="icon" href="{{ asset('templates/neon/assets/images/favicon.ico') }}">
    <title>@yield('title', 'Pengarsipan')</title>
    <link rel="stylesheet" href="{{ asset('templates/neon/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/neon/assets/css/font-icons/entypo/css/entypo.css') }}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('templates/neon/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/neon/assets/css/neon-core.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/neon/assets/css/neon-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/neon/assets/css/neon-forms.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/neon/assets/css/custom.css') }}">
    @yield('custom_css')
    <script src="{{ asset('templates/neon/assets/js/jquery-1.11.3.min.js') }}"></script>
    <!--[if lt IE 9]><script src="{{ asset('templates/neon/assets/js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="page-body" data-url="http://neon.dev">
    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <div class="sidebar-menu">
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset('templates/neon/assets/images/logo@2x.png') }}" width="120" alt="" />
                        </a>
                    </div>
                    <!-- logo collapse icon -->
                    <div class="sidebar-collapse">
                        <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                    <div class="sidebar-mobile-menu visible-xs">
                        <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                </header>
                <ul id="main-menu" class="main-menu">
                    @include('layouts.partials.navbar')
                </ul>
            </div>
        </div>
        <div class="main-content">
            <h2>Here starts everything...</h2>
            <br />
            @yield('content')
            <!-- lets do some work here... -->
            <!-- Footer -->
            <footer class="main">{{-- 
                &copy; 2015 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>
             --}}</footer>
        </div>
    </div>
    <!-- Bottom scripts (common) -->
    <script src="{{ asset('templates/neon/assets/js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('templates/neon/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('templates/neon/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('templates/neon/assets/js/joinable.js') }}"></script>
    <script src="{{ asset('templates/neon/assets/js/resizeable.js') }}"></script>
    <script src="{{ asset('templates/neon/assets/js/neon-api.js') }}"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="{{ asset('templates/neon/assets/js/neon-custom.js') }}"></script>
    @yield('custom_js')
</body>
</html>