@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edición de roles</h3>
            </div>
            <div class="box-body">

                @include('partials.error-messages')

                <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                  {{ method_field('PUT') }}
                  {{-- {{ csrf_field() }} 
                     

                    <div class="form-group">
                        <label>Rol:</label>
                        <input value="{{ $role->name }}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="display_name">Descripción Rol:</label>
                        <input name="display_name" value="{{ old('display_name', $role->display_name) }}" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="guard">Guard:</label>
                        <select name="guard_name" class="form-control">
                            @foreach (config('auth.guards') as $guardName => $guard)
                            <option {{ old('guard_name', $role->guard_name) === $guardName ? 'selected' : '' }} value="{{ $guardName }}">{{ $guardName }}</option>


                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Permisos</label>
                        <hr>
                        @include('admin.permissions.checkboxes', ['model' => $role])
                    </div> --}}

                    @include('admin.roles.form')

                    <button class="btn btn-primary btn-block">Actualizar rol</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
