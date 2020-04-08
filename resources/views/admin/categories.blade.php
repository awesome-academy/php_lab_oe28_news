@extends('admin.layouts.app')

@section('title', trans('pages.categories'))

@section('menu')
    <li><a href="">{{ trans('pages.news') }}</a></li>
    <li><a href="">{{ trans('pages.users') }}</a></li>
    <li class="active"><a href="">{{ trans('pages.categories') }}</a></li>
@endsection

@section('content')

@endsection
