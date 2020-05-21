@extends('admin.layouts.app')

@section('title', trans('pages.write_news'))

@section('menu')
    <li class="active"><a href="{{ route('write.createNews') }}">{{ trans('pages.write_news') }}</a></li>
    <li><a href="{{ route('write.index') }}">{{ trans('pages.my_news') }}</a></li>
@endsection

@section('content')
    <section class="single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ trans('pages.news') }}</strong><br>
                        </div>
                        <div class="card-body card-block">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    <strong>{{ session()->get('success') }}</strong>
                                </div>
                            @endif
                            @include('common.errors')
                            <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">{{ trans('pages.title') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">{{ trans('category') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="category_id" id="select" class="form-control">
                                            <option
                                            @foreach ($categories as $category)
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
                                        <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">{{ trans('pages.content') }}</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="news_content" id="news_content" rows="9" class="form-control" data-error="{{ trans('pages.image_format') }}"></textarea>
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
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">{{ trans('pages.hot') }}</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="inline-checkbox1" class="form-check-label ">
                                                <input type="checkbox" id="inline-checkbox1" name="hot"
                                                       value="{{ config('news.hot.yes') }}"
                                                       class="form-check-input">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i>{{ trans('pages.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ trans('pages.insert_photo') }}</strong><br>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="photo-upload">
                                @csrf
                                <input type="file" id="photo_input" name="select_file"/>
                                <button class="btn btn-primary btn-sm" data-href="{{ route('write.photo') }}" id="photo_submit">{{ trans('pages.insert') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
