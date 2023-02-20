<div class="gallery-photos masonry">

    @foreach($post->photos->take(4) as $photo)
    <figure class="gallery-image">
        @if($loop->iteration === 4)
        <div class="overlay" style="height: 310px; width:466px">{{ $post->photos->count() }} Fotos...</div>
        @endif
        <img src="{{ url(asset('storage/'.$photo->url)) }}" class="img-responsive" alt="">
    </figure>
    @endforeach

</div>
