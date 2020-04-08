<header class="primary">
    <div class="firstbar">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="brand">
                        <a href="">
                            <h1>{{ trans('pages.news') }}</h1>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <form class="search" autocomplete="off">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Type something here">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="ion-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 col-sm-12 text-right">
                    <ul class="nav-icons">
                        @if (Auth::check())
                            <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <li><a><i class="ion-person"></i>
                                        <div>{{ Auth::user()->name }}</div>
                                    </a></li>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon ion-person"></i>{{ trans('pages.profile') }}</a></li>
                                <li><a href="#"><i class="icon ion-settings"></i>{{ trans('pages.admin') }}</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="#"><i class="icon ion-log-out"></i>{{ trans('pages.logout') }}</a></li>
                            </ul>
                        @else
                            <li><a href=""><i class="ion-person-add"></i>
                                    <div>{{ trans('pages.register') }}</div>
                                </a></li>
                            <li><a href=""><i class="ion-person"></i>
                                    <div>{{ trans('pages.login') }}</div>
                                </a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="menu">
        <div class="container">
            <div id="menu-list">
                <ul class="nav-list">
                    <li><a href="">{{ trans('pages.home') }}</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
