@extends('admin.layouts.app')

@section('title', trans('messages.write_news'))

@section('menu')
    <li><a href="">{{ trans('pages.my_news') }}</a></li>
    <li class="active"><a href="">{{ trans('pages.write_news') }}</a></li>
@endsection

@section('content')
    <form>
        <div class="form-group">
            <label for="exampleFormControlInput1">{{ trans('pages.title') }}</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">{{ trans('pages.description') }}</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">{{ trans('pages.image') }}</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">{{ trans('pages.content') }}</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ trans('pages.save') }}</button>
        </div>
    </form>
@endsection
