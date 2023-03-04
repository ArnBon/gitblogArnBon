<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersPermissionsController extends Controller
{
    public function update(Request $request, User $user)
    {
        // $user->syncPermissions($request->permissions);
        // return back()->withFlash('Los permisos han sido actualizados');

        /*pero asi da un problema ya que el metodo getStoredPermission() propio de spaty espera que se le 
        envie la informacion de forma correcta y se le esta enviando
        campos null para resolverlo lo hacemos asi:
        */

        $user->permissions()->detach(); //con esto quita los permisos

        if ($request->filled('permissions')) { // el usuario ha seleccionado algun permiso??
            $user->givePermissionTo($request->permissions); //si seleccionó algun permiso le pasamos el array de permisos ($request->permissions) si el array esta vacio quiere decir que el 
        }
        return back()->withFlash('Los permisos han sido actualizados');
    }
}