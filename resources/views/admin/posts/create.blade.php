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
        <form>
                <div class="col-md-8">
                    <div class="box box-primary">                        
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Título de la publicación</label>
                                    <input name="txttitle" class="form-control" placeholder="Ingresa aqui el titulo de la publicación">
                                </div>
                                <div class="form-group">
                                    <label>Contenido publicación</label>
                                    <textarea rows="10" name="body" class="form-control" 
                                    placeholder="Ingresa un extracto de la publicación"></textarea>                           
                                </div>
                            </div> 
                    </div>
                </div>
                <div class="col-md-4">
                <div class="box box-primary">                        
                        <div class="box-body">
                            <div class="form-group">
                                <label>Extracto publicación</label>
                                <textarea name="excerpt" class="form-control" placeholder="Ingresa un extracto de la publicación"></textarea>
                            </div>
                        </div>       
                    </div>
                </div>
        </form>
    </div>
@stop