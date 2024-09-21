<div class="category-container">
    <ul>
        <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
            <a href="{{ route('home.index') }}">Todo</a>
        </li>

        @if (isset($navbar) && $navbar->isNotEmpty())
            @foreach ($navbar as $category)
                <li class="nav-item {!! (Request::path() == 'category/' . $category->slug ? 'active' : '') !!}">
                    <a href="{{ route('categories.detail', $category->slug) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        @else
            <li>No hay categorías disponibles.</li>
        @endif

        <li class="nav-item {{ request()->routeIs('home.all-categories') ? 'active' : '' }}">
            <a href="{{ route('home.all-categories') }}">Todas las categorías</a>
        </li>
    </ul>
</div>