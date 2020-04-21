@extends('layouts.app')

@section('title', trans('pages.profile'))

@section('content')
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>{{ trans('pages.profile') }}</h4>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <a>{{ session()->get('success') }}</a>
                            </div>
                        @endif
                        @include('common.errors')
                        <form action="{{ route('user.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>{{ trans('pages.name') }}</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('pages.email') }}</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('pages.phone_number') }}</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}">
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">{{ trans('pages.update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
