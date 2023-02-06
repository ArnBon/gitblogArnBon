<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        return view('welcome', [
            'category' => $category,
            'posts' => $category->posts()->paginate(1)
        ]);
        /**de este modo estamos enviando una variable posts a la vista welcome pero solamente con los posts que pertenecen
         * a esta categoria a diferencia del home que estamos pasando todos los posts
         * 
        */
    }
}
