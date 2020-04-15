<!DOCTYPE html>
<html lang="en">
<head>

    <title>@yield('title')</title>

    <link href="{{ asset('bower_components/bower-package/admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/bower-package/admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}"
          rel="stylesheet" media="all">
    <link
        href="{{ asset('bower_components/bower-package/admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/bower-package/admin/vendor/bootstrap-4.1/bootstrap.min.css') }}"
          rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/bower-package/admin/vendor/animsition/animsition.min.css') }}"
          rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/bower-package/admin/css/theme.css') }}" rel="stylesheet" media="all">
    <link
        href="{{ asset('bower_components/bower-package/admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/bower-package/admin/vendor/wow/animate.css') }}" rel="stylesheet"
          media="all">
    <link href="{{ asset('bower_components/bower-package/admin/vendor/css-hamburgers/hamburgers.min.css') }}"
          rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/bower-package/admin/vendor/slick/slick.css" rel="stylesheet') }}"
          rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/bower-package/admin/vendor/select2/select2.min.css') }}" rel="stylesheet"
          media="all">
    <link href="{{ asset('bower_components/bower-package/admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}"
          rel="stylesheet" media="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="animsition">
<div class="page-wrapper">
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="#">
                <img src="{{ asset('images/icon/news.png') }}" alt="{{ trans('pages.profile') }}"/>
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    @yield('menu')
                </ul>
            </nav>
        </div>
    </aside>
    <div class="page-container">
        @include('admin.layouts.header')
        <div class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('bower_components/bower-package/admin/vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/animsition/animsition.min.js') }}"></script>
<script
    src="{{ asset('bower_components/bower-package/admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
<script
    src="{{ asset('bower_components/bower-package/admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script
    src="{{ asset('bower_components/bower-package/admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('bower_components/bower-package/admin/js/main.js') }}"></script>
<script src="{{ mix('js/alert.js') }}"></script>
</body>
</html>
