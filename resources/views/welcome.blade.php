	@extends('layout')

	@section('content')
	<section class="posts container">
	    <!--se creo for each en el video 3-->
	    @foreach($posts as $post)
	    <article class="post">
	        @if($post->photos->count() === 1)
	        <figure><img src="{{ $post->photos->first()->url }}" alt="" class="img-responsive"></figure>
	        @elseif($post->photos->count() > 1)
	        <div class="gallery-photos masonry">

	            @foreach($post->photos->take(4) as $photo)
	            <figure class="gallery-image">	                
	                @if($loop->iteration === 4)
	                <div class="overlay" style="height: 310px; width:466px">{{ $post->photos->count() }} Fotos...</div>
	                @endif	                
	                <img src="{{ url($photo->url) }}" class="img-responsive" alt="">
	            </figure>
	            @endforeach

	        </div>
			@elseif($post->iframe)


			<div class="video">
			{!! $post->iframe !!}
			</div>


	        @endif

	        <div class="content-post">
	            <header class="container-flex space-between">
	                <div class="date">
	                    <span class="c-gray-1">{{$post->published_at->diffForHumans()}}</span>
	                </div>
	                <div class="post-category">
	                    <span class="category text-capitalize">{{ $post->category->name }}</span>
	                </div>
	            </header>
	            <h1>{{ $post->title }}</h1>
	            <div class="divider"></div>
	            <p>{{ $post->excerpt }}</p>
	            <footer class="container-flex space-between">
	                <div class="read-more">
	                    <a href="blog/{{ $post->url }}" class="text-uppercase c-green">Leer más</a>
	                </div>
	                <div class="tags container-flex">
	                    @foreach($post->tags as $tag)
	                    <span class="tag c-gray-1 text-capitalize">{{ $tag->name }}</span>
	                    @endforeach

	                </div>
	            </footer>
	        </div>
	    </article>
	    @endforeach


	</section>
	<!-- fin del div.posts.container -->
{{ $posts->links() }}
	{{-- <div class="pagination">
	    <ul class="list-unstyled container-flex space-center">
	        <li><a href="#" class="pagination-active">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	    </ul>
	</div> --}}
	@stop
