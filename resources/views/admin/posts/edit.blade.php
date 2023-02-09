@extends('admin.layout')

@section('header')
<h1>
    POSTS
    Crear publicación
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{route('admin.posts.index')}}"><i class="fa fa-list"></i> Posts</a></li>
    <li class="active">Crear</li>
</ol>
@stop

@section('content')
<div class="row">



    @if($post->photos->count())
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                @foreach($post->photos as $photo)
                <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                    {{method_field('DELETE')}} {{csrf_field()}}
                    <div class="col-md-2">
                        <button class="btn btn-danger btn-xs" style="position: absolute"><i class="fa fa-remove"></i></button>
                        <img class="img-responsive" src="{{ url($photo->url) }}">
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
    @endif




    <form method="POST" action="{{ route('admin.posts.update', $post)}}">
        {{csrf_field()}} {{ method_field('PUT') }}
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label>Título de la publicación</label>
                        <input name="title" class="form-control" placeholder="Ingresa aqui el titulo de la publicación" value="{{ old('title', $post->title)}}">
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : ''  }}">
                        <label>Contenido publicación</label>
                        <textarea rows="10" id="editor" name="body" class="form-control" placeholder="Ingresa un extracto de la publicación">{{ old('body', $post->body) }}</textarea>
                        {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                    </div>


                    <div class="form-group {{ $errors->has('iframe') ? 'has-error' : '' }}">
							<label>Contenido embebido (iframe)</label>
							<textarea rows="2" name="iframe" id="editor" class="form-control" placeholder="Ingresa contenido embebido (iframe) de audio o video">{{ old('iframe', $post->iframe) }}</textarea>
							{!! $errors->first('iframe', '<span class="help-block">:message</span>') !!}
					</div>

                    
                </div>



            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body">
                    <!-- Date -->
                    <div class="form-group ">
                        <label>Fecha de publicación:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="published_at" class="form-control pull-right" value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }}" id="datepicker">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.end Date -->
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''  }}">
                        <label>Categorías</label>
                        <select name="category_id" class="form-control select2">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categories as $category)

                            <option value="{{ $category->id }}" {{old('category_id', $post->category_id) == $category->id ? 'selected': ''}}>
                                {{ $category->name }}
                            </option>

                            @endforeach
                        </select>
                        {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                    </div>


                    <div class="form-group {{ $errors->has('tags') ? 'has-error' : ''  }}">
                        <label>Etiquetas</label>
                        <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Selecciona una o mas etiquetas" style="width: 100%;">
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                            @endforeach
                        </select>
                        {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                    </div>

                    
                    <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : ''  }}">
                        <label>Extracto publicación</label>
                        <textarea name="excerpt" class="form-control" placeholder="Ingresa un extracto de la publicación">{{ old('excerpt', $post->excerpt) }}</textarea>
                        {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                    </div>

                    <!--video 26 imagen con dropzone-->
                    <div class="form-group">
                        <div class="dropzone"></div>
                    </div>
                    <!--fin -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Guardar publicación</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@stop

@push('styles')
<!--DropZone css-->
<link rel="stylesheet" href="\adminlte\bower_components\dropzone\css\dropzone.css">
<!-- bootstrap datepicker css-->
<link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
@endpush

@push('scripts')
<!-- DropZone -->
<script src="\adminlte\bower_components\dropzone\js\dropzone.min.js"></script>
<!-- CK Editor -->
<script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
<!--descargue la version 4.6.2 y la renombre la version vieja como ckeditorold -->
<!-- Select2 -->
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker js-->
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!--Datepicker-->
<script>
    $('#datepicker').datepicker({
        autoclose: true
    });

    //Initialize Select2 Elements
    $('.select2').select2({
        tags: true
    });

    CKEDITOR.replace('editor');
    CKEDITOR.config.height = 430;

    var myDropzone = new Dropzone('.dropzone', {
        url: '/admin/posts/{{ $post->url }}/photos'
        , acceptedFiles: 'image/*', //con esto solo permite imagenes        
        maxFilesize: 2, //restringir el tamaño del archivo medido en megas
        paramName: 'photo'
        , headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
        , dictDefaultMessage: 'Arrastra las fotos aqui para subirlas'
    });

    myDropzone.on('error', function(file, res) {

        var msg = res.errors.photo[0];
        $('.dz-error-message:last > span').text(msg);
    });

    Dropzone.autoDiscover = false; //para que no se autoinicialize

</script>

@endpush
