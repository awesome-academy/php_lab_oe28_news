<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/scripts/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/scripts/ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/scripts/toast/jquery.toast.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/scripts/owlcarousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/scripts/owlcarousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/scripts/magnific-popup/dist/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/scripts/sweetalert/dist/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/css/skins/all.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower-package/css/demo.css') }}">

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="skin-orange">
        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')

        <script src="{{ asset('bower_components/bower-package/js/jquery.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/js/jquery.migrate.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/scripts/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{ mix('js/main.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/scripts/jquery-number/jquery.number.min.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/scripts/owlcarousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/scripts/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/scripts/easescroll/jquery.easeScroll.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/scripts/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/scripts/toast/jquery.toast.min.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/admin/vendor/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/js/demo.js') }}"></script>
        <script src="{{ asset('bower_components/bower-package/js/e-magz.js') }}"></script>
        <script src="{{ mix('js/like.js') }}"></script>
    </body>
</html>
