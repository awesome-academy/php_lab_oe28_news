@extends('admin.layouts.app')

@section('title', trans('pages.news_detail'))

@section('menu')
    <li class="active"><a href="{{ route('admin.news.index') }}">{{ trans('pages.news') }}</a></li>
    <li><a href="">{{ trans('pages.users') }}</a></li>
    <li><a href="{{ route('admin.categories.index') }}">{{ trans('pages.categories') }}</a></li>
@endsection

@section('content')
    <section class="single">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <article class="article main-article">
                        <header>
                            <h1>{{$news->title}}</h1>
                            <ul class="details">
                                <li>{{ $news->created_at->format(config('news.date_format')) }}</li>
                                <li>{{ $news->category->name }}</li>
                                <li>{{ trans('pages.by').$news->user->name }}</li>
                            </ul>
                        </header>
                        <div class="main">
                            <b>{{ $news->description }}</b>
                            <p>{!!  $news->content !!}</p>
                        </div>
                        <footer>
                            <div class="col">
                            </div>
                            <div class="col"><i class="zmdi zmdi-mood"></i> {{ $news->likes->count() }}
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
                                                </footer>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ trans('pages.option') }}:</strong>
                            <div class="col-md-9">
                                <div class="table-data-feature">
                                    @if ($news->status == App\Enums\NewsStatus::StatusApproved)
                                        <a class="item" data-toggle="tooltip"
                                           href="{{ route('admin.news.status', [$news->id, App\Enums\NewsStatus::StatusPublished]) }}"
                                           title="{{ trans('pages.publish') }}">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </a>
                                        <a class="item" data-toggle="tooltip"
                                           href="{{ route('admin.news.status', [$news->id, App\Enums\NewsStatus::StatusRejected]) }}"
                                           title="{{ trans('pages.reject') }}">
                                            <i class="zmdi zmdi-close"></i>
                                        </a>
                                    @elseif ($news->status == App\Enums\NewsStatus::StatusPublished)
                                        <a class="item" data-toggle="tooltip"
                                           href="{{ route('admin.news.status', [$news->id, App\Enums\NewsStatus::StatusApproved]) }}"
                                           title="{{ trans('pages.take_down') }}">
                                            <i class=" zmdi zmdi-triangle-down"></i>
                                        </a>
                                    @endif
                                    <button class="item delete-confirm" data-toggle="tooltip"
                                            data-confirm="{{ trans('pages.news_delete_confirm') }}"
                                            data-title="{{ trans('pages.news_delete_title') }}"
                                            data-error="{{ trans('pages.error') }}"
                                            href="{{ route('news.destroy', $news->id) }}"
                                            title="{{ trans('pages.delete') }}">
                                        <i class=" zmdi zmdi-delete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('news.update', $news->id) }}" method="post"
                                  enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('PATCH')
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label class=" form-control-label">{{ trans('pages.status') }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="form-control-static">{{ config("news.status.$news->status") }}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">{{ trans('pages.hot') }}</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="inline-checkbox1" class="form-check-label ">
                                                @if ($news->hot)
                                                    <input type="checkbox" checked="checked" id="inline-checkbox1"
                                                           name="hot" value="{{ config('news.hot.yes') }}"
                                                           class="form-check-input">
                                                @else
                                                    <input type="checkbox" id="inline-checkbox1" name="hot"
                                                           value="{{ config('news.hot.yes') }}"
                                                           class="form-check-input">
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">{{ trans('category') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="category_id" id="select" class="form-control">
                                            <option value="{{ $news->category->id }}">{{ $news->category->name }}  ( {{ $category->parent->name ?? '' }} )</option>
                                            @foreach ($categories as $category)
                                                @if ($category == $news->category)
                                                    @continue
                                                @endif
                                                <option value="{{ $category->id }}">{{ $category->name }} ( {{ $category->parent->name ?? '' }} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">{{ trans('pages.replace_image') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="file-input" name="image" class="form-control-file">
                                    </div>
                                    @include('common.errors')
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i>{{ trans('pages.update') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center">
                        <strong>{{ trans('pages.image') }}</strong>
                        <img src="{{ asset('images/news/' . $news->image) }}" class="rounded" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
