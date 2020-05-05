@extends('admin.layouts.app')

@section('title', trans('pages.news')))

@section('menu')
    <li class="active"><a href="{{ route('review.index') }}">{{ trans('pages.news') }}</a></li>
@endsection

@section('content')
    <section class="single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ trans('pages.news') }}</strong><br>
                            {{ $news->title }}
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('PATCH')
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">{{ trans('pages.title') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="title" class="form-control" value="{{ $news->title }}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">{{ trans('category') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="category_id" id="select" class="form-control">
                                            <option
                                                value="{{ $news->category->id }}">{{ $news->category->name }} ({{ $news->category->parent->name ?? ''}})</option>
                                            @foreach ($categories as $category)
                                                @if ($category == $news->category)
                                                    @continue
                                                @endif
                                                <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->parent->name ?? ''}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">{{ trans('pages.description') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="description" id="description" rows="5" class="form-control">{{ $news->description }}</textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">{{ trans('pages.content') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="news_content" id="description" rows="9" class="form-control">{{ $news->content }}</textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">{{ trans('pages.image') }}</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <input type="file" id="file-input" name="image" class="form-control-file">
                                    </div>
                                    <div class="col col-md-3"></div>
                                    <div class="col col-lg-9">
                                        <img src="{{ asset('images/news/' . $news->image) }}" class="rounded" alt="{{ $news->title }}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i>{{ trans('pages.update') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>{{ trans('pages.option') }}:</strong>
                                    <div class="col-md-9">
                                        <div class="table-data-feature">
                                            @if ($news->status == App\Enums\NewsStatus::StatusApproved)
                                                <a class="item" data-toggle="tooltip"
                                                   href="{{ route('review.status', [$news->id, App\Enums\NewsStatus::StatusRejected]) }}"
                                                   title="{{ trans('pages.reject') }}">
                                                    <i class="zmdi zmdi-close"></i>
                                                </a>
                                            @elseif ($news->status == App\Enums\NewsStatus::StatusNew || $news->status == App\Enums\NewsStatus::StatusRejected || $news->status == App\Enums\NewsStatus::StatusNeedEditMore)
                                                <a class="item" data-toggle="tooltip"
                                                   href="{{ route('review.status', [$news->id, App\Enums\NewsStatus::StatusApproved]) }}"
                                                   title="{{ trans('pages.approve') }}">
                                                    <i class="zmdi zmdi-check"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-block">
                                    <label>{{ trans('pages.status') . ': ' }}</label>
                                    <a>{{ config("news.status.$news->status") }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>{{ trans('pages.review') }}</strong>
                                </div>
                                <div class="card-body">
                                    <article class="article main-article">
                                        <header>
                                            <h2>{{$news->title}}</h2>
                                            <ul class="details">
                                                <li>{{ $news->created_at->format(config('news.date_format')) }}</li>
                                                <li>{{ $news->category->name }}</li>
                                                <li>{{ trans('pages.by').$news->user->name }}</li>
                                            </ul>
                                        </header>
                                        <div class="main">
                                            <b>{{ $news->description }}</b>
                                            <p>{!! $news->content !!}</p>
                                        </div>
                                        <footer>
                                            <div class="col">
                                            </div>
                                            <div class="col"><i class="zmdi zmdi-mood"></i> {{ $news->likes->count() }}
                                            </div>
                                        </footer>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
