@extends('admin.layout')

@section('header')
        <h1>
        Todas las publicaciones
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Posts</li>
      </ol>
@stop

@section('content')
<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Publicaciones</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="posts-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Extracto</th>
                  <th>Acciones</th>                 
                </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($posts as $post)
                           <td>{{ $post->id }}</td>
                           <td>{{ $post->title }}</td>
                           <td>{{ $post->excerpt }}</td>
                           <td>
                                <a href="#"class="btn btn-xs btn-default" target="_blank"><i class = "fa fa-eye" ></i></a>
                                <a href="#" class="btn btn-xs btn-info" target="_blank"><i class = "fa fa-pencil"></i></a>                                
                                <a href="#" class="btn btn-xs btn-danger"><i class = "fa fa-trash"></i></a>
                                
                            </td>
                    </tr>
                        @endforeach                           
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Extracto</th>
                  <th>Acciones</th>                 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
@stop




