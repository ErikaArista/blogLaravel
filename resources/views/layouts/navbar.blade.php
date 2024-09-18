<div class="category-container">
    <ul>
        <li class="nav-item {{request()->routeIs('home.index') ? 'active' : ' '}} ">
            <a href="{{route('home.index')}}">Todo</a></li>         
        
        @foreach ($navbar as $category)
        {{-- Para que no puedan modificar datos desde el frontend --}}
            <li class="nav-item {!! (Request::path() ) == 'category/' .$category->slug ? 'active' : ' ' !!}">
                <a href="{{route('categories.detail', $category->slug)}}">{{$category->name}}</a>
            </li>
        @endforeach

        <li class="nav-item {{request()->routeIs('home.all') ? 'active' : ' '}} ">
            <a href="{{route('home.all')}}">Todas las categorias</a>
        </li>
        
        <li class="nav-item ">
            <a href="#"></a>
        </li>


    </ul>
</div>