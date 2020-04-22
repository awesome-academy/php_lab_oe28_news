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
                            @foreach ($news->comments->load('user')->where('parent_id', null) as $comment)
                                <div class="item comment{{ $comment->id }}">
                                    <div class="user">
                                        <div class="details">
                                            <h5 class="name">{{ $comment->user->name }}</h5>
                                            <div class="time">{{ $comment->created_at }}</div>
                                            <div class="description">{{ $comment->content }}</div>
                                            <footer>
                                                @if ($comment->user->id == Auth::id())
                                                    <button class="btn btn-primary btn-sm comment-delete"
                                                            href="{{ route('user.deleteComment') }}"
                                                            data-title="{{ trans('pages.news_delete_title') }}"
                                                            data-error="{{ trans('pages.error') }}"
                                                            data-id="{{ $comment->id }}">
                                                        <i>{{ trans('pages.delete') }}</i>
                                                    </button>
                                                @endif
                                            </footer>
                                        </div>
                                    </div>
                                    @if ($comment->children != null)
                                        <div class="reply-list">
                                            @foreach ($comment->children->load('user') as $subComment)
                                                <div class="item comment{{ $subComment->id }} comment{{ $comment->id }}">
                                                    <div class="user">
                                                        <div class="details">
                                                            <h5 class="name">{{ $subComment->user->name }}</h5>
                                                            <div class="time">{{ $subComment->created_at }}</div>
                                                            <div class="description">{{ $subComment->content }}</div>
                                                            <footer>
                                                                @if ($subComment->user->id == Auth::id())
                                                                    <button class="btn btn-primary btn-sm comment-delete"
                                                                            href="{{ route('user.deleteComment') }}"
                                                                            data-title="{{ trans('pages.news_delete_title') }}"
                                                                            data-error="{{ trans('pages.error') }}"
                                                                            data-id="{{ $subComment->id }}">
                                                                        <i>{{ trans('pages.delete') }}</i>
                                                                    </button>
                                                                @endif
                                                            </footer>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                                <div class="item">
                                                    <div class="user">
                                                        @include('common.errors')
                                                        <form class="row" action="{{ route('user.comment', $news->slug) }}" method="POST">
                                                            @csrf
                                                            <div class="form-group col-md-12">
                                                                <label for="message">{{ trans('pages.reply') }} <span class="required"></span></label>
                                                                <input class="form-control" name="comment_content" placeholder="{{ trans('pages.write_comment') }} ..."></input>
                                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}"/>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <button class="btn btn-primary btn-sm">{{trans('pages.reply')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @include('common.errors')
                        <form class="row" action="{{ route('user.comment', $news->slug) }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <h3 class="title">{{ trans('pages.leave_your_comments') }}</h3>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="message">{{ trans('pages.comment') }} <span class="required"></span></label>
                                <textarea class="form-control" name="comment_content" placeholder="{{ trans('pages.write_comment') }} ..."></textarea>
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
