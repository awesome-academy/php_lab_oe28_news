@extends('admin.layouts.app')

@section('title', trans('pages.users'))

@section('menu')
    <li><a href="">{{ trans('pages.news') }}</a></li>
    <li class="active"><a href="">{{ trans('pages.users') }}</a></li>
    <li><a href="{{ route('admin.categories.index') }}">{{ trans('pages.categories') }}</a></li>
@endsection

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('pages.name') }}</th>
            <th scope="col">{{ trans('pages.email') }}</th>
            <th scope="col">{{ trans('pages.phone_number') }}</th>
            <th scope="col">{{ trans('pages.username') }}</th>
            <th scope="col">{{ trans('pages.role') }}</th>
            <th scope="col">{{ trans('pages.option') }}</th>
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
