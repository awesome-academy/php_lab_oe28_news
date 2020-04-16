<header class="primary">
    <div class="firstbar">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="brand">
                        <a href="{{ route('home') }}">
                            <h1>{{ trans('pages.news') }}</h1>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <form class="search" autocomplete="off" action="{{ route('search') }}" method="GET">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="keyWord" class="form-control" placeholder="{{ trans('pages.type_something') }}">
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
                                <li><a href="{{ route('logout') }}"><i class="icon ion-log-out"></i>{{ trans('pages.logout') }}</a></li>
                            </ul>
                        @else
                            <li><a href="{{ route('indexRegister') }}"><i class="ion-person-add"></i>
                                    <div>{{ trans('pages.register') }}</div>
                                </a></li>
                            <li><a href="{{ route('indexLogin') }}"><i class="ion-person"></i>
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
            <div class="brand">
                <a href="{{ route('home') }}"><h1>{{ trans('pages.news') }}</h1></a>
            </div>
            <div class="mobile-toggle">
                <a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
            </div>
            <div class="mobile-toggle">
                <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
            </div>
            <div id="menu-list">
                <ul class="nav-list">
                    <li><a href="{{ route('home') }}">{{ trans('pages.home') }}</a></li>
                    @php
                        $headerCategories = App\Http\Models\Category::with(['news', 'children'])->where('parent_id', null)->get();
                    @endphp
                    @foreach ($headerCategories as $category)
                        @if (count($category->children) == 0)
                            <li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                        @else
                            @include('layouts.headerCategories', ['categories' => $category->children, 'parent' => $category])
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>
