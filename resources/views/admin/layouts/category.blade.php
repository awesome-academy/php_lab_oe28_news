@foreach ($categories as $category)
    @if ($category->children->count() == 0)
        <p><button class="btn btn-sm">{{ $category->name }}</button>
            <button class="item" data-toggle="tooltip" title="{{ trans('pages.edit') }}"><a href="{{ route('admin.categories.edit', $category->id) }}"><i class="zmdi zmdi-edit"></i></a></button>
            <button class="item category-delete-confirm" data-toggle="tooltip"
                    data-category-confirm="{{ trans('pages.category_delete_confirm') }}"
                    data-category-title="{{ trans('pages.news_delete_title') }}"
                    data-category-error="{{ trans('pages.error') }}"
                    href="{{ route('categories.destroy', $category->id) }}"
                    title="{{ trans('pages.delete') }}">
                <i class=" zmdi zmdi-delete"></i>
            </button>
        </p>
    @else
        <p>
            <button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#collapseExample{{ $category->id }}">{{ $category->name }}</button>
            <button class="item" data-toggle="tooltip" title="{{ trans('pages.edit') }}"><a href="{{ route('admin.categories.edit', $category->id) }}"><i class="zmdi zmdi-edit"></i></a></button>
        </p>
        <div class="collapse show" id="collapseExample{{ $category->id }}">
            <div class="card card-body">
                @include('admin.layouts.category', ['categories' => $category->children])
            </div>
        </div>
    @endif
@endforeach
