<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
    <meta name="theme-color" content="#999a38">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/select2/dist/css/select2.min.css') }}">
    <link href="{{ asset('matrix/assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('matrix/assets/libs/jquery-smartWizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('matrix/assets/libs/jquery-smartWizard/dist/css/smart_wizard_theme_circles.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('matrix/assets/libs/jquery-smartWizard/dist/css/smart_wizard_theme_dots.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('matrix/dist/css/style.min.css') }}" rel="stylesheet">

    <style>
        .sick-wrapper {
            min-height: 100vh;
            position: relative; }
        .sick-wrapper .auth-man {
            background: #fff;
            padding: 20px;
            max-width: 400px;}
        .sick-wrapper .auth-man .logo {
            text-align: center; }
        .sick-wrapper .auth-man.on-sidebar {
            top: 0px;
            right: 0px;
            height: 100%;
            margin: 0px;
            position: absolute; }
        .sick-wrapper #recoverform {
            display: none; }
        .sick-wrapper .auth-sidebar {
            position: fixed;
            height: 100%;
            right: 0px;
            overflow: auto;
            margin: 0px;
            top: 0px; }

        @media (max-width: 767px) {
            .sick-wrapper .auth-sidebar {
                position: relative;
                max-width: 100%;
                width: 100%;
                margin: 40px 0 60px; }
            .sick-wrapper .demo-text {
                margin-top: 30px; } }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="main-wrapper">
        {{--<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-trans">
            <ul class="navbar-nav ml-auto" style="text-transform: uppercase;letter-spacing: .1rem;font-size: .825rem;">
                <li class="nav-item">
                    @if (request()->url() === route('banksampah.register'))
                        <a class="nav-link font-14 font-bold" href="{{ route('login') }}">Login</a>
                        @else
                        <a class="nav-link font-14 font-bold" href="{{ route('banksampah.register') }}">Registrasi</a>
                    @endif
                </li>
            </ul>
        </nav>--}}
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div id="app">
            @yield('content')
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
    </div>
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('matrix/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('matrix/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('matrix/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{--<script src="{{ asset('matrix/assets/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>--}}
    <script src="{{ asset('matrix/assets/libs/toastr/build/toastr.min.js') }}"></script>
    {{--<script src="{{ asset('matrix/assets/libs/jquery-smartWizard/dist/js/jquery.smartWizard.min.js') }}"></script>--}}
    <script src="{{ asset('matrix/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('matrix/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    @yield('extra-script')
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function(){

            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
        @if (session('status'))
            var mxxx = (function() {
                toastr.info('{!! session('status') !!}');
            })();
        @endif

        function initializeSelect2(obj) {
            obj.select2({
                placeholder: obj.attr('placeholder'),
                width: '100%'
            });
        }

        $(".select2").each(function() {
            initializeSelect2($(this));
        });
    </script>
</body>
</html>
