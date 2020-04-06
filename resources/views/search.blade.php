@extends('layouts.app')

@section('title', 'Search')

@section('content')
    <section class="search">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <aside>
                        <h2 class="aside-title">{{ trans('pages.search') }}</h2>
                        <div class="aside-body">
                            <form>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control"
                                               placeholder="{{ trans('pages.type_something') }} ..." value="hello">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">
                                                <i class="ion-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </aside>
                    <aside>
                        <h2 class="aside-title">{{ trans('pages.filter') }}</h2>
                        <div class="aside-body">
                            <form class="checkbox-group">
                                <div class="group-title">{{ trans('pages.categories') }}</div>
                                <div class="form-group">
                                    <label><input type="checkbox" name="category" checked>{{ trans('pages.all_categories') }}</label>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
                <div class="col-md-9">
                    <div class="nav-tabs-group">
                        <ul class="nav-tabs-list">
                            <li class="active"><a href="#">{{ trans('pages.all') }}</a></li>
                            <li><a href="#">{{ trans('pages.latest') }}</a></li>
                            <li><a href="#">{{ trans('pages.hot') }}</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <article class="col-md-12 article-list">
                            <div class="inner">
                                <figure>
                                    <a href="">
                                        <img src="">
                                    </a>
                                </figure>
                                <div class="details">
                                    <div class="detail">
                                        <div class="category">
                                            <a href=""></a>
                                        </div>
                                        <div class="time"></div>
                                    </div>
                                    <h1><a href=""></a></h1>
                                    <p>

                                    </p>
                                    <footer>
                                        <a href="#" class="love"><i class="ion-android-favorite-outline"></i>
                                            <div></div>
                                        </a>
                                        <a class="btn btn-primary more" href="">
                                            <div>{{ trans('pages.more') }}</div>
                                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                                        </a>
                                    </footer>
                                </div>
                            </div>
                        </article>
                        <div class="col-md-12 text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
