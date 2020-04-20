@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('pages.home') }}</a></li>
                                @for ($i = count($uriCategory) - 1; $i >= 0; $i--)
                                    <li><a href="{{ route('category', $uriCategory[$i]->slug) }}">{{ $uriCategory[$i]->name }}</a></li>
                                @endfor
                                <li class="active">{{ $category->name }}</li>
                            </ol>
                            <ol class="breadcrumb">
                                @foreach ($category->children as $child)
                                    <li><a href="{{ route('category', $child->slug) }}">{{ $child->name }}</a></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="row">
                        @foreach ($newsOfCategory as $news)
                            <article class="col-md-12 article-list">
                                <div class="inner">
                                    <figure>
                                        <a href="{{ route('news.show', $news->slug) }}">
                                            <img src="{{ asset('images/news/' . $news->image) }}">
                                        </a>
                                    </figure>
                                    <div class="details">
                                        <div class="detail">
                                            <div class="category">
                                                <a href="{{ route('category', $news->category->slug) }}">{{ $news->category->name }}</a>
                                            </div>
                                            <div class="time">{{ $news->created_at->format(config('news.date_format')) }}</div>
                                        </div>
                                        <h1><a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a></h1>
                                        <p>{{ $news->description }}</p>
                                        <footer>
                                            <a href="" class="love"><i class="ion-android-favorite-outline"></i>
                                                <div>{{ $news->likes->count() }}</div>
                                            </a>
                                            <a class="btn btn-primary more" href="{{ route('news.show', $news->slug) }}">
                                                <div>{{ trans('pages.more') }}</div>
                                                <div><i class="ion-ios-arrow-thin-right"></i></div>
                                            </a>
                                        </footer>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        <div class="col-md-12 text-center">
                            {{ $newsOfCategory->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 sidebar">
                </div>
            </div>
        </div>
    </section>
@endsection
