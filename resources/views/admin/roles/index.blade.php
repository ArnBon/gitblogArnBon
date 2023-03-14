@extends('admin.layout')

@section('header')
<h1>
    Todos los Roles
    <small>Optional description</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Roles</li>
</ol>
@stop
@section('content')

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Listado de roles</h3>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Roles</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="roles-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rol</th>
                    <th>Guard</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($roles as $role)
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    
                    <td>
                        <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-pencil"></i></a>


                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" style="display: inline">
                            {{csrf_field()}} {{method_field('DELETE')}}
                            <button class="btn btn-xs btn-danger" onclick="return confirm('Se va a eliminar este Rol')">
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
        $('#roles-table').DataTable({
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

