<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /*esta clase la cree yo, no lo creo el auth por defecto video 11
    esta clase se movio a la carpeta Admin en el video 13 y se comento su constructor*/
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view('admin.dashboard');

    }
}
