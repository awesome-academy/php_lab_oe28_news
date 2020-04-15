@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('pages.home') }}</a></li>
                                @for ($i = count($uriCategory) - 1; $i >= 0; $i--)
                                    <li><a href="{{ route('category', $uriCategory[$i]->id) }}">{{ $uriCategory[$i]->name }}</a></li>
                                @endfor
                                <li class="active">{{ $category->name }}</li>
                            </ol>
                            <ol class="breadcrumb">
                                @foreach ($category->children as $child)
                                    <li><a href="{{ route('category', $child->id) }}">{{ $child->name }}</a></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="row">
                        <article class="col-md-12 article-list">
                            <div class="inner">
                                <figure>
                                    <a href="">
                                        <img src="{{ asset('images/icon/news.png') }}">
                                    </a>
                                </figure>
                                <div class="details">
                                    <div class="detail">
                                        <div class="category">
                                            <a href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
                                        </div>
                                        <div class="time"></div>
                                    </div>
                                    <h1><a href=""></a></h1>
                                    <p>

                                    </p>
                                    <footer>
                                        <a href="#" class="love"><i class="ion-android-favorite-outline"></i>
                                            <div></div>
                                        </a>
                                        <a class="btn btn-primary more" href="">
                                            <div>{{ trans('pages.more') }}</div>
                                            <div><i class="ion-ios-arrow-thin-right"></i></div>
                                        </a>
                                    </footer>
                                </div>
                            </div>
                        </article>
                        <div class="col-md-12 text-center">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 sidebar">
                </div>
            </div>
        </div>
    </section>
@endsection
