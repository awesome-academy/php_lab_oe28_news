@extends('layouts.app')

@section('title', trans('pages.login'))

@section('content')
<section class="login first grey">
    <div class="container">
        <div class="box-wrapper">
            <div class="box box-border">
                <div class="box-body">
                    <h4>{{ trans('pages.login') }}</h4>
                    @include('common.errors')
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session()->get('message') }}</div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ trans('pages.username') }}</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="fw">{{ trans('pages.password') }}
                            </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="remember-me" class="fw"><span>{{ trans('remember_me') }}</span>
                                <span><input id="remember-me" name="remember" type="checkbox"></span>
                            </label>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block">{{ trans('pages.login') }}</button>
                        </div>
                        <div class="form-group text-center">
                            <span class="text-muted">{{ trans('pages.dont_have_account') }}</span> <a href="">{{ trans('pages.create_one') }}</a>
                        </div>
                        <div class="title-line">
                            {{ trans('pages.or') }}
                        </div>
                        <a href="#" class="btn btn-social btn-block facebook"><i class="ion-social-facebook"></i>{{ trans('pages.login_with_facebook') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
