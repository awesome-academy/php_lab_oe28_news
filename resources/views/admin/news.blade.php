@extends('admin.layouts.app')

@section('title', trans('pages.news'))

@section('menu')
    <li class="active"><a href="{{ route('adminNews') }}">{{ trans('pages.news') }}</a></li>
    <li><a href="">{{ trans('pages.users') }}</a></li>
    <li><a href="">{{ trans('pages.categories') }}</a></li>
@endsection

@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('pages.title') }}</th>
                                <th>{{ trans('pages.description') }}</th>
                                <th>{{ trans('pages.content') }}</th>
                                <th>{{ trans('pages.image') }}</th>
                                <th>{{ trans('pages.created_at') }}</th>
                                <th>{{ trans('pages.updated_at') }}</th>
                                <th>{{ trans('pages.hot') }}</th>
                                <th>{{ trans('pages.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($listNews as $news)
                                <tr class="tr-shadow">
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ route('adminShowNews', $news->id) }}">{{ Str::limit($news->title) }}</a></td>
                                    <td>{{ Str::limit($news->description) }}</td>
                                    <td>{{ Str::limit($news->content, 100) }}</td>
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
                                                <div class="table-data-feature">
                                                    <a class="item" data-toggle="tooltip" href="{{ route('adminNewsStatus', [$news->id, App\Enums\NewsStatus::StatusPublished]) }}" title="{{ trans('pages.publish') }}">
                                                        <i class="zmdi zmdi-mail-send"></i>
                                                    </a>
                                                    <a class="item" data-toggle="tooltip" href="{{ route('adminNewsStatus', [$news->id, App\Enums\NewsStatus::StatusRejected]) }}" title="{{ trans('pages.reject') }}">
                                                        <i class="zmdi zmdi-close"></i>
                                                    </a>
                                                </div>
                                            @elseif ($news->status == App\Enums\NewsStatus::StatusPublished)
                                                <div class="table-data-feature">
                                                    <a class="item" data-toggle="tooltip" href="{{ route('adminNewsStatus', [$news->id, App\Enums\NewsStatus::StatusApproved]) }}" title="{{ trans('pages.take_down') }}">
                                                        <i class=" zmdi zmdi-triangle-down"></i>
                                                    </a>
                                                </div>
                                            @endif
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
