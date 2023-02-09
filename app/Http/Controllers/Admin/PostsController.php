<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    // public function create()
    // {
    //     $categories = Category::all();
    //     $tags = Tag::all();
    //     return view('admin.posts.create', compact('categories', 'tags'));
    // }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required']); //validamos

        $post = Post::create( $request->only('title') );

        return redirect()->route('admin.posts.edit', $post); //redireccionamos
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
       
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));  //aqui muestra la vista de edit
    }

    public function update(Post $post, StorePostRequest $request) 
    {   
        $post->update($request->all());
        $post->syncTags($request->get('tags'));
        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Tu publicación ha sido guardada !!');
    }
}