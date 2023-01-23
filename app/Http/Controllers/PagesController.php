<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        // $posts = \App\Post::latest('published_at')->get(); // sin importar use App\Post 
        $posts = $post = Post::latest('published_at')->get(); // importando use App\Post
        return view('welcome', compact('posts'));
    }
}
