@extends('admin.layouts.app')

@section('title', trans('pages.my_news'))

@section('menu')
    <li class="active"><a href="">{{ trans('pages.my_news') }}</a></li>
    <li><a href="">{{ trans('pages.write_news') }}</a></li>
@endsection

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('pages.title') }}</th>
            <th scope="col">{{ trans('pages.description') }}</th>
            <th scope="col">{{ trans('pages.content') }}</th>
            <th scope="col">{{ trans('pages.image') }}</th>
            <th scope="col">{{ trans('pages.hot') }}</th>
            <th scope="col">{{ trans('pages.status') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
@endsection
