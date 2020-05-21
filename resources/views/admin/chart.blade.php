@extends('admin.layouts.app')

@section('title', trans('pages.news_of_year'))

@section('menu')
    <li><a href="{{ route('admin.news.index') }}">{{ trans('pages.news') }}</a></li>
    <li><a href="">{{ trans('pages.users') }}</a></li>
    <li><a href="{{ route('admin.categories.index') }}">{{ trans('pages.categories') }}</a></li>
    <li class="active"><a href="{{ route('admin.chart') }}">{{ trans('pages.news_of_year') }}</a></li>
@endsection

@section('content')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <canvas id="news_chart" data-news="@json($data)" data-info="{{ trans('pages.news_of_month') }}"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
