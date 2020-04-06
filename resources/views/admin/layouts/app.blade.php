<!DOCTYPE html>
<html lang="en">
<head>

    <title>@yield('title')</title>

    <link href="{{ asset('public/bower_components/bower-package/admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/font-awesome/css/all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/animsition/dist/css/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/bower_components/bower-package/admin/css/theme.css') }}" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('images/icon/news.png') }}" alt="{{ trans('pages.profile') }}" />
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

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/animsition/dist/js/animsition.min.js') }}"></script>

    <script src="{{ asset('public/bower_components/bower-package/admin/js/main.js') }}"></script>
</body>
</html>
