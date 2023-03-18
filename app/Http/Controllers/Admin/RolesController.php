<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRolesRequest;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create', [
            'permissions' => Permission::pluck('name', 'id'),
            'role'       => new Role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRolesRequest $request)
    {
        // $data = $request->validate([
        //     'name'         => 'required|unique:roles',
        //     'display_name' => 'required',
        //    // 'guard_name'   => 'required'
        // ], [
        //     'name.required' => 'El campo rol es obligatorio',
        //     'name.unique' => 'Este rol ya ha sido registrado',
        //     'display_name.required' => 'El campo Descripción rol es obligatorio'
        // ]);

        $role = Role::create($request->validated());

         //    asignamos los roles
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        //Retornamos un mensaje al usuario
            return redirect()->route('admin.roles.index')->with('flash', 'El rol fue creado correctamente'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRolesRequest $request, Role $role)
    {
        // $data = $request->validate([ 'display_name' => 'required' ], 
        // [
        //     'display_name.required' => 'El campo rol es obligatorio'
        // ]);

        $role->update($request->validated());

        //quitamos todos los permisos antes de asignarlos en la actualización
        $role->permissions()->detach();

        //    asignamos los roles
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        //Retornamos un mensaje al usuario
            return redirect()->route('admin.roles.edit', $role)->with('flash', 'El rol fue actualizado correctamente');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
