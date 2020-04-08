@extends('layouts.app')

@section('title', trans('pages.profile'))

@section('content')
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>{{ trans('pages.profile') }}</h4>
                        <form>
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
