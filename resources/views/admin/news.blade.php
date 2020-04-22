@extends('admin.layouts.app')

@section('title', trans('pages.news'))

@section('menu')
    <li class="active"><a href="{{ route('admin.news.index') }}">{{ trans('pages.news') }}</a></li>
    <li><a href="">{{ trans('pages.users') }}</a></li>
    <li><a href="{{ route('admin.categories.index') }}">{{ trans('pages.categories') }}</a></li>
@endsection

@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <form class="form-header" action="{{ route('admin.news.search') }}" method="GET">
                            @csrf
                            <input class="au-input au-input--xl" type="text" name="keyWord"
                                   placeholder="{{ trans('pages.search') }}..." value="{{ $keyWord ?? '' }}"/>
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                        <a class="btn btn-outline-primary btn-sm"
                           href="{{ route('admin.news.index') }}">{{ trans('pages.all') }}</a>
                        @foreach ($categories as $category)
                            @if(isset($curCategory) && $curCategory->id == $category->id)
                                <a class="btn btn-primary btn-sm"
                                   href="{{ route('admin.news.category', $category->id) }}">{{ $category->name }}</a>
                            @else
                                <a class="btn btn-outline-primary btn-sm"
                                   href="{{ route('admin.news.category', $category->id) }}">{{ $category->name }}</a>
                            @endif
                        @endforeach
                        <table class="table table-borderless table-striped">
                            <thead>
                            <tr>
                                <th>{{ trans('pages.title') }}</th>
                                <th>{{ trans('pages.description') }}</th>
                                <th>{{ trans('pages.category') }}</th>
                                <th>{{ trans('pages.image') }}</th>
                                <th>{{ trans('pages.created_at') }}</th>
                                <th>{{ trans('pages.updated_at') }}</th>
                                <th>{{ trans('pages.hot') }}</th>
                                <th>{{ trans('pages.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($listNews as $news)
                                <tr class="tr-shadow">
                                    <td>
                                        <a href="{{ route('admin.news.show', $news->id) }}">{{ Str::limit($news->title) }}</a>
                                    </td>
                                    <td>{{ Str::limit($news->description) }}</td>
                                    <th>{{ $news->category->name }}</th>
                                    <td>{{ $news->image }}</td>
                                    <td>{{ $news->created_at }}</td>
                                    <td>{{ $news->updated_at }}</td>
                                    <td>
                                        @if ($news->hot)
                                            <span class="badge badge-danger">{{ trans('pages.hot') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ config("news.status.$news->status") }}
                                        <br>
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
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $listNews->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
