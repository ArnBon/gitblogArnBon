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
        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Crear Publicaciones</button>
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
                        <a href="#" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>

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

@push('styles')
<!-- DataTables css-->
<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('scripts')
<!-- DataTables js-->
<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Datatables -->
<script>
    $(function() {
        $('#posts-table').DataTable({
            'paging': true
            , 'lengthChange': true
            , 'searching': true
            , 'ordering': true
            , 'info': true
            , 'autoWidth': false
        })
    })

</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form method="POST" action="{{ route('admin.posts.store')}}">
        {{csrf_field()}}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agrega el título de tu nueva publicación</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        {{-- <label>Título de la publicación</label> --}}
                        <input name="title" class="form-control" placeholder="Ingresa aqui el titulo de la publicación" value="{{old('title')}}">
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Crear publicación</button>
                </div>
            </div>
        </div>
</div>
</form>
<!-- fin modal-->

@endpush
