@extends('layouts.app')

@section('title', trans('pages.home'))

@section('content')
    <section class="home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="line">
                        <div>{{ trans('pages.hot_news')}}</div>
                    </div>
                    <div class="row">
                        <article class="article col-md-8">
                            <div class="item">
                                <article class="featured">
                                    <div class="overlay"></div>
                                    <figure>
                                        <img src="{{ asset('images/news/' . $hotNews->first()->image) }}"
                                             alt="{{ $hotNews->first()->title }}">
                                    </figure>
                                    <div class="details">
                                        <div class="category"><a href="">{{ $hotNews->first()->category->name }}</a>
                                        </div>
                                        <h1>
                                            <a href="{{ route('news.show', $hotNews->first()->id) }}">{{ $hotNews->first()->title }}</a>
                                        </h1>
                                        <div class="time">{{ $hotNews->first()->created_at->format(config('news.date_format')) }}</div>
                                    </div>
                                </article>
                            </div>
                        </article>
                        <div class="col-md-4">
                            @foreach ($hotNews as $news)
                                @if ($loop->index != 0)
                                    <article class="article-mini">
                                        <div class="inner">
                                            <figure>
                                                <a href="{{ route('news.show', $news->id) }}">
                                                    <img src="{{ asset('images/news/' . $news->image) }}"
                                                         alt="{{ $news->title }}">
                                                </a>
                                            </figure>
                                            <div class="padding">
                                                <h1><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a>
                                                </h1>
                                            </div>
                                        </div>
                                    </article>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="line">
                        <div>{{ trans('pages.latest_news') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                @foreach ($latestNews as $news)
                                    <article class="article col-md-12">
                                        <div class="inner">
                                            <figure>
                                                <a href="{{ route('news.show', $news->id) }}">
                                                    <img src="{{ asset('images/news/' . $news->image) }}"
                                                         alt="{{ $news->title }}">
                                                </a>
                                            </figure>
                                            <div class="padding">
                                                <div class="detail">
                                                    <div class="time">{{ $news->created_at->format(config('news.date_format')) }}</div>
                                                    <div class="category"><a href="">{{ $news->category->name }}</a>
                                                    </div>
                                                </div>
                                                <h2><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a>
                                                </h2>
                                                <p>{{ $news->description }}</p>
                                                <footer>
                                                    <a href="#" class="love"><i
                                                            class="ion-android-favorite-outline"></i>
                                                        <div>{{ $news->likes->count() }}</div>
                                                    </a>
                                                    <a class="btn btn-primary more"
                                                       href="{{ route('news.show', $news->id) }}">
                                                        <div>{{ trans('pages.more') }}</div>
                                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                                    </a>
                                                </footer>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    @foreach ($listCategories as $categories)
                        <div class="line">
                            <div>{{ $categories[0]->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    @foreach ($categories[1]->sortByDesc('created_at')->take(config('news.category.take')) as $news)
                                        @if ($loop->index == 0)
                                            <article class="article col-md-6">
                                                <div class="inner">
                                                    <figure>
                                                        <a href="{{ route('news.show', $news->id) }}">
                                                            <img src="{{ asset('images/news/' . $news->image) }}"
                                                                 alt="{{ $news->title }}">
                                                        </a>
                                                    </figure>
                                                    <div class="padding">
                                                        <div class="detail">
                                                            <div
                                                                class="time">{{ $news->created_at->format(config('news.date_format')) }}</div>
                                                            <div class="category"><a
                                                                    href="">{{ $news->category->name }}</a>
                                                            </div>
                                                        </div>
                                                        <h2>
                                                            <a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a>
                                                        </h2>
                                                        <p>{{ $news->description }}</p>
                                                        <footer>
                                                            <a href="#" class="love"><i
                                                                    class="ion-android-favorite-outline"></i>
                                                                <div>{{ $news->likes->count() }}</div>
                                                            </a>
                                                            <a class="btn btn-primary more"
                                                               href="{{ route('news.show', $news->id) }}">
                                                                <div>{{ trans('pages.more') }}</div>
                                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                                            </a>
                                                        </footer>
                                                    </div>
                                                </div>
                                            </article>
                                        @else
                                            <article class="article col-md-6">
                                                <article class="article-mini">
                                                    <div class="inner">
                                                        <figure>
                                                            <a href="{{ route('news.show', $news->id) }}">
                                                                <img src="{{ asset('images/news/' . $news->image) }}"
                                                                     alt="{{ $news->title }}">
                                                            </a>
                                                        </figure>
                                                        <div class="padding">
                                                            <h1>
                                                                <a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </article>
                                            </article>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
