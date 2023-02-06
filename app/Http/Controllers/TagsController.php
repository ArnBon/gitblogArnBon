<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        return view('welcome', [
            'title' => "Publicaciones de las etiquetas '{$tag->name}'",
            'posts' => $tag->posts()->paginate()
        ]);
        /**de este modo estamos enviando una variable posts a la vista welcome pero solamente con los posts que pertenecen
         * a esta categoria a diferencia del home que estamos pasando todos los posts
         * 
        */
    }
}
