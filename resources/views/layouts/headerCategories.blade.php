<li class="dropdown"><a href="{{ route('category', $parent->slug) }}">{{ $parent->name }}<i class="ion-ios-arrow-right"></i></a>
    <ul class="dropdown-menu">
        @foreach ($categories as $category)
            @if (count($category->children) == 0)
                <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
            @else
                @include('layouts.headerCategories', ['categories' => $category->children, 'parent' => $category])
            @endif
        @endforeach
    </ul>
</li>
