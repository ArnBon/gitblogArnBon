@extends('layout')

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)

@section('content')
<article class="post container">

    {{-- @if($post->photos->count() === 1) --}}
    {{-- <figure><img src="{{ url($post->photos->first()->url) }}" alt="" class="img-responsive"></figure> --}}
    {{-- @include('posts.photo')
    @elseif($post->photos->count() > 1)
    @include('posts.carousel')
    @elseif($post->iframe) --}}
    {{-- <div class="video">
        {!! $post->iframe !!}
    </div> --}}
    {{-- @include('posts.carousel-preview')
    @endif --}}

    {{-- CON VISTAS POLIMORFICAS --}}
        @include( $post->viewType() )
	{{-- FIN VISTAS POLIMORFICAS --}}

    <div class="content-post">
        {{-- <header class="container-flex space-between">
            <div class="date">
                <span class="c-gris">
                    {{ optional ($post->published_at)->format('M-d') / {{ $post->owner->name }} }} 
                </span>
            </div>

            @if($post->category)
            <div class="post-category">
                <span class="category">{{ $post->category->name }}</span>
            </div>
            @endif

        </header> --}}
        @include('posts.header')

        <h1>{{ $post->title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text">

            {!! $post->body !!}

        </div>

        <footer class="container-flex space-between">

            @include('partials.social-links', ['description' => $post->title])
            {{-- <div class="tags container-flex">
                @foreach($post->tags as $tag)
                <span class="tag c-gris">{{ $tag->name }}</span>
                @endforeach
            </div> --}}            
            @include('posts.tags')
        </footer>
        <div class="comments">
            <div class="divider"></div>
            <div id="disqus_thread"></div>
            <!--video 20 -->
            @include('partials.disqus-script')
        </div><!-- .comments -->
    </div>
</article>
@endsection

@push('styles')
<link rel="stylesheet" href="/css/twitter-bootstrap.css">
@endpush

@push('scripts')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/js/twitter-bootstrap.js"></script>
@endpush
