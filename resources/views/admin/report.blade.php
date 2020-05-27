<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('pages.report') }}</title>

    <link href="{{ asset('bower_components/bower-package/admin/vendor/bootstrap-4.1/bootstrap.min.css') }}"
          rel="stylesheet" media="all">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>{{ trans('pages.news_of_week') }}</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-striped">
                        <thead>
                        <tr>
                            <th>{{ trans('pages.title') }}</th>
                            <th>{{ trans('pages.category') }}</th>
                            <th>{{ trans('pages.created_at') }}</th>
                            <th>{{ trans('pages.hot') }}</th>
                            <th>{{ trans('pages.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listNews as $news)
                            <tr class="tr-shadow">
                                <td>
                                    <a href="{{ route('admin.news.show', $news->id) }}">{{ Str::limit($news->title) }}</a>
                                </td>
                                <th>{{ $news->category->name }}</th>
                                <td>{{ $news->created_at }}</td>
                                <td>
                                    @if ($news->hot)
                                        <span class="badge badge-danger">{{ trans('pages.hot') }}</span>
                                    @endif
                                </td>
                                <td>{{ config("news.status.$news->status") }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
