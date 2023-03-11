@extends('admin.layout')

@section('header')
<h1>
    Todas los Usuarios
    <small>Optional description</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Usuarios</li>
</ol>
@stop
@section('content')

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Listado de usuarios</h3>
         <a href="{{ route('admin.users.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Usuarios</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="users-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($users as $user)
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-pencil"></i></a>

                        
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline">
                        {{csrf_field()}} {{method_field('DELETE')}}
                        <button class="btn btn-xs btn-danger" onclick="return confirm('Se va a eliminar esta publicación')">
                        <i class="fa fa-trash"></i></button>
                        </form>


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
        $('#users-table').DataTable({
            'paging': true
            , 'lengthChange': true
            , 'searching': true
            , 'ordering': true
            , 'info': true
            , 'autoWidth': false
        })
    })

</script>

@endpush
