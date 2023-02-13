<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        //video 20 queryScope
        // $post = Post::find($id);
        // return view('posts.show', compact('post'));

        //video 21 model bindings
        // return view('posts.show', compact('post'));

        // if ($post->isPublished() || auth()->check()) 
        // {
        //     return view('posts.show', compact('post'));
        // }
        abort(404);
    }
}
