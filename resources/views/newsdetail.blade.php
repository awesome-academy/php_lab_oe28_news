@extends('layouts.app')

@section('title', 'Title')

@section('content')
    <section class="single">
        <div class="container">
            <div class="row">
                <div class="col-md-4 sidebar" id="sidebar">
                </div>
                <div class="col-md-8">
                    <ol class="breadcrumb">
                        <li><a href="#">{{ trans('pages.home') }}</a></li>
                        <li class="active"></li>
                    </ol>
                    <article class="article main-article">
                        <header>
                            <h1></h1>
                            <ul class="details">
                                <li></li>
                                <li>{{ trans('pages.by') }} <a href="#"></a></li>
                            </ul>
                        </header>
                        <div class="main">
                            <b></b>
                            <p></p>
                        </div>
                        <footer>
                            <div class="col">
                            </div>
                            <div class="col">
                                <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>1220</div></a>
                            </div>
                        </footer>
                    </article>
                    <div class="author"></div>
                    <div class="line thin"></div>
                    <div class="comments">
                        <h2 class="title">{{ trans('pages.comments') }}</h2>
                        <div class="comment-list">
                            <div class="item">
                                <div class="user">
                                    <div class="details">
                                        <h5 class="name"></h5>
                                        <div class="time"></div>
                                        <div class="description">

                                        </div>
                                        <footer>
                                            <a href="#">{{ trans('pages.reply') }}</a>
                                        </footer>
                                    </div>
                                </div>
                                <div class="reply-list">
                                    <div class="item">
                                        <div class="user">
                                            <div class="details">
                                                <h5 class="name"></h5>
                                                <div class="time"></div>
                                                <div class="description">

                                                </div>
                                                <footer>
                                                    <a href="#">{{ trans('pages.reply') }}</a>
                                                </footer>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="row">
                            <div class="col-md-12">
                                <h3 class="title">{{ trans('pages.leave_your_comments') }}</h3>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="message">{{ trans('pages.comment') }} <span class="required"></span></label>
                                <textarea class="form-control" name="message" placeholder="{{ trans('pages.write_comment') }} ..."></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-primary">{{trans('pages.comment')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
