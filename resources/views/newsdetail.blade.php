@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <section class="single">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{ trans('pages.home') }}</a></li>
                        @for ($i = count($uriCategory) - 1; $i >= 0; $i--)
                            <li><a href="{{ route('category', $uriCategory[$i]->slug) }}">{{ $uriCategory[$i]->name }}</a></li>
                        @endfor
                        <li class="active">{{ $news->category->name }}</li>
                    </ol>
                    <article class="article main-article">
                        <header>
                            <h1>{{$news->title}}</h1>
                            <ul class="details">
                                <li>{{ $news->created_at->format(config('news.date_format')) }}</li>
                                <li><a href="{{ route('category', $news->category->slug) }}">{{ $news->category->name }}</a></li>
                                <li>{{ trans('pages.by').$news->user->name }}</li>
                            </ul>
                        </header>
                        <div class="main">
                            <b>{{ $news->description }}</b>
                            <p>{{ $news->content }}</p>
                        </div>
                        <footer>
                            <div class="col">
                            </div>
                            <div class="col">
                                @if (Auth::check())
                                    <a data-href1="{{ route('user.like') }}" data-slug="{{ $news->slug }}" data-error="{{ trans('pages.error') }}" class="love{{ $news->isAuthUserLikedNews() ? ' active' : '' }}">
                                        <i class="ion-android-favorite"></i>
                                        <div>{{ $news->likes->count() }}</div>
                                    </a>
                                @else
                                    <a class="love block-click"><i class="ion-android-favorite-outline"></i> <div>{{ $news->likes->count() }}</div></a>
                                @endif
                            </div>
                        </footer>
                    </article>
                    <div class="author"></div>
                    <div class="line thin"></div>
                    <div class="comments">
                        <h2 class="title">{{ trans('pages.comments') }}</h2>
                        <div class="comment-list">
                            <div class="item">
                                <div class="user">
                                    <div class="details">
                                        <h5 class="name"></h5>
                                        <div class="time"></div>
                                        <div class="description">

                                        </div>
                                        <footer>
                                            <a href="#">{{ trans('pages.reply') }}</a>
                                        </footer>
                                    </div>
                                </div>
                                <div class="reply-list">
                                    <div class="item">
                                        <div class="user">
                                            <div class="details">
                                                <h5 class="name"></h5>
                                                <div class="time"></div>
                                                <div class="description">

                                                </div>
                                                <footer>
                                                    <a href="#">{{ trans('pages.reply') }}</a>
                                                </footer>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="row">
                            <div class="col-md-12">
                                <h3 class="title">{{ trans('pages.leave_your_comments') }}</h3>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="message">{{ trans('pages.comment') }} <span class="required"></span></label>
                                <textarea class="form-control" name="message" placeholder="{{ trans('pages.write_comment') }} ..."></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-primary">{{trans('pages.comment')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
