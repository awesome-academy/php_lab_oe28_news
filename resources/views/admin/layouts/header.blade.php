<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div><h1>
                    @yield('title')
                </h1></div>
                <div class="header-button">
                    @if (Auth::user()->role_id == App\Enums\UserRole::Admin || Auth::user()->role_id == App\Enums\UserRole::Reviewer)
                        <div class="noti-wrap">
                            <div class="noti__item js-item-menu">
                                <i class="zmdi zmdi-notifications"></i>
                                @if (Auth::user()->unreadNotifications->count() != config('news.empty'))
                                    <span class="quantity notify-count">{{ Auth::user()->unreadNotifications->count() }}</span>
                                @endif
                                <div class="notifi-dropdown js-dropdown pre-scrollable"
                                     data-count="{{ Auth::user()->unreadNotifications->count() }}"
                                     data-key="{{ env('PUSHER_APP_KEY') }}"
                                     data-id="{{ Auth::id() }}"
                                     data-link="{{ route('review.notification', '') }}"
                                     data-title="{{ trans('pages.news_notify') }}">
                                    @foreach (Auth::user()->notifications as $notification)
                                        <div class="notifi__item">
                                            @if ($notification->read())
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                            @else
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-email"></i>
                                                </div>
                                            @endif
                                            <div class="content">
                                                <p>{{ trans('pages.news_notify') }}</p>
                                                <a href="{{ route('review.notification', $notification->id) }}">{{ $notification->data['title'] }}</a><br>
                                                <span class="date">{{ $notification->data['time'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
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
                                            <img src="{{ asset('images/icon/account.png') }}" alt="{{ Auth::user()->name }}" />
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
                                        <a href="{{ route('user.profile', Auth::user()->username) }}"></i>{{ trans('pages.profile') }}</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ route('home') }}"></i>{{ trans('pages.home') }}</a>
                                    </div>
                                </div>
                                @if (Auth::user()->role_id == App\Enums\UserRole::Admin)
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('admin.news.index') }}"></i>{{ trans('pages.admin') }}</a>
                                        </div>
                                    </div>
                                @endif
                                @if (Auth::user()->role_id == App\Enums\UserRole::Admin || Auth::user()->role_id == App\Enums\UserRole::Reviewer)
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('review.index') }}"></i>{{ trans('pages.review_news') }}</a>
                                        </div>
                                    </div>
                                @endif
                                @if (Auth::user()->role_id == App\Enums\UserRole::Admin || Auth::user()->role_id == App\Enums\UserRole::Writer)
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route("write.createNews") }}"></i>{{ trans('pages.write_news') }}</a>
                                        </div>
                                    </div>
                                @endif
                                <div class="account-dropdown__footer">
                                    <a href="{{ route('logout') }}"></i>{{ trans('pages.logout') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
