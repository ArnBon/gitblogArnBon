@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Crear Roles</h3>
            </div>
            <div class="box-body">

               @include('partials.error-messages')

                <form method="POST" action="{{ route('admin.roles.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">Descripción Rol:</label>
                        <input name="name" value="{{ old('name') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="guard">Guard:</label>                        
                        <select name="guard_name" class="form-control">
                            @foreach (config('auth.guards') as $guardName => $guard)
                                <option {{ old('guard_name') === $guardName ? 'selected' : '' }} 
                                 value="{{ $guardName }}">{{ $guardName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Permisos</label>
                        <hr>
                        @include('admin.permissions.checkboxes', ['model' => $role])
                    </div>
                    <button class="btn btn-primary btn-block">Crear rol</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection