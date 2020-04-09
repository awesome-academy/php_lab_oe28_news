@extends('layouts.app')

@section('title', trans('pages.register'))

@section('content')
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>{{ trans('pages.register') }}</h4>
                        @include('common.errors')
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>{{ trans('pages.name') }}</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('pages.email') }}</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('pages.phone_number') }}</label>
                                <input type="text" name="phone_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('pages.username') }}</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="fw">{{ trans('pages.password') }}</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">{{ trans('pages.register') }}</button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">{{ trans('pages.have_account') }}</span> <a href="login.html">{{ trans('pages.login') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
