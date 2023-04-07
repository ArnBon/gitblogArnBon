@extends('layout')

@section('content')
<section class="pages container">
    <div class="page page-archive">
        <h1 class="text-capitalize">Archivo</h1>
        <p>Nam efficitur, massa quis fringilla volutpat, ipsum massa consequat nisi, sed eleifend orci sem sodales lorem. Curabitur molestie eros urna, eleifend molestie risus placerat sed.</p>
        <div class="divider-2" style="margin: 35px 0;"></div>
        <div class="container-flex space-between">
            <div class="authors-categories">
                <h3 class="text-capitalize">Autores</h3>
                <ul class="list-unstyled">
                    @foreach ($authors as $author)
                    <li>{{ $author->name }}</li>
                    @endforeach
                </ul>
                <h3 class="text-capitalize">categorias</h3>
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                    <li class="text-capitalize">
                        <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                    </li>
                    @endforeach

                </ul>
            </div>
            <div class="latest-posts">
                <h3 class="text-capitalize">Últimos posts</h3>

                @foreach ($posts as $post)
                <p><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></p>
                @endforeach

                <h3 class="text-capitalize">posts por mes</h3>
                <ul class="list-unstyled">
                    @foreach ($archive as $date)
                    <a href="{{ route('pages.home', ['month' => $date->month, 'year' => $date->year]) }}">
                    <li>{{ $date->monthname }} {{ $date->year }} ({{ $date->posts }})</li></a>
                    
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
