<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div><h1>
                    @yield('title')
                </h1></div>
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{ asset('images/icon/account.png') }}" alt="{{ trans('pages.admin') }}" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="">{{ Auth::user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('images/icon/account.png') }}" alt="Admin" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                        <a href=""></a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#"></i>{{ trans('pages.profile') }}</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="#"></i>{{ trans('pages.logout') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
