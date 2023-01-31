<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    // public function store(Request $request) 
    // {     
    //     $this->validate($request, [
    //     'title'    =>'required',
    //     'body'     =>'required',
    //     'category' =>'required',
    //     'tags'     =>'required',
    //     'excerpt'  => 'required'
    //     ]); 
    //     $post = new Post;
    //     $post->title        = $request->get('title');
    //     $post->url          = str_slug($request->get('title'));
    //     $post->body         = $request->get('body');
    //     $post->excerpt      = $request->get('excerpt');
    //     $post->published_at = $request->filled('published_at') ? Carbon:: parse($request->get('published_at')) : null; 
    //     $post->category_id  = $request->get('category');
    //     $post->save();
    //     $post->tags()->attach($request->get('tags'));
    //     return back()->with('flash', 'Tu publicación ha sido creada!');
    // }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required']); //validamos

        $post = Post::create([                              //guardamos
            'title' => $request->get('title'),
            'url'   => str_slug($request->get('title')),
        ]);
        return redirect()->route('admin.posts.edit', $post); //redireccionamos
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));  //aqui muestra la vista de edit
    }
}
