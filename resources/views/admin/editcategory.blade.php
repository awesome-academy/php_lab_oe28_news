@extends('admin.layouts.app')

@section('title', trans('pages.edit'))

@section('menu')
    <li><a href="{{ route('admin.news.index') }}">{{ trans('pages.news') }}</a></li>
    <li><a href="">{{ trans('pages.users') }}</a></li>
    <li class="active"><a href="{{ route('admin.categories.index') }}">{{ trans('pages.categories') }}</a></li>
@endsection

@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">{{ $curCategory->name }} ({{ $curCategory->parent->name ?? '' }})</div>
                        <div class="card-body">
                            @include('common.errors')
                            <form action="{{ route('categories.update', $curCategory->id) }}" method="post" novalidate="novalidate">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label class="control-label mb-1">{{ trans('pages.rename_category') }}</label>
                                    <input name="name" type="text" class="form-control" value="{{ $curCategory->name }}">
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label mb-1">{{ trans('pages.parent') }}</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="-1"></option>
                                        <option value="">{{ trans('pages.root_category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}  ( {{ $category->parent->name ?? '' }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-lg btn-info btn-block">
                                        <span >{{ trans('pages.update') }}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-title text-center">
                            <h3>{{ trans('pages.categories') }}</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($rootCategories as $category)
                                @if ($category->children->count() == 0)
                                    <p><button class="btn btn-sm" >{{ $category->name }}</button>
                                        <button class="item" data-toggle="tooltip" title="{{ trans('pages.edit') }}"><a href="{{ route('admin.categories.edit', $category->id) }}"><i class="zmdi zmdi-edit"></i></a></button>
                                        <button class="item category-delete-confirm" data-toggle="tooltip"
                                                data-category-confirm="{{ trans('pages.category_delete_confirm') }}"
                                                data-category-title="{{ trans('pages.news_delete_title') }}"
                                                data-category-error="{{ trans('pages.error') }}"
                                                href="{{ route('categories.destroy', $category->id) }}"
                                                title="{{ trans('pages.delete') }}">
                                            <i class=" zmdi zmdi-delete"></i>
                                        </button>
                                    </p>
                                @else
                                    <p>
                                        <button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#collapseExample{{ $category->id }}">{{ $category->name }}</button>
                                        <button class="item" data-toggle="tooltip" title="{{ trans('pages.edit') }}"><a href="{{ route('admin.categories.edit', $category->id) }}"><i class="zmdi zmdi-edit"></i></a></button>
                                    </p>
                                    <div class="collapse  show" id="collapseExample{{ $category->id }}">
                                        <div class="card card-body">
                                            @include('admin.layouts.category', ['categories' => $category->children])
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
