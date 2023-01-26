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

    public function store(Request $request) /**video 17 */
    {
        /***Aqui va la validacion de los campos video 18**/
            $this->validate($request, [
            'title'    =>'required',
            'body'     =>'required',
            'category' =>'required',
            'tags'     =>'required',
            'excerpt'  => 'required'
            ]);
        /**fin validacion */


        $post = new Post;

        $post->title        = $request->get('title');
        $post->body         = $request->get('body');
        $post->excerpt      = $request->get('excerpt');
        // $post->published_at = Carbon::parse($request->get('published_at')); esto es en el video 16
        // $post->published_at = $request->has('published_at') ? Carbon::parse($request->get('published_at')) : null;
        $post->published_at = $request->filled('published_at') ? Carbon:: parse($request->get('published_at')) : null; 
        // esto es en el video 17 metodo has no sirve el metodo correcto es filled
        /** con el metodo has sigue creando la fecha no la deja en null ESE ES EL ERROR QUE DA OJO CON ESTO */
        $post->category_id  = $request->get('category');
        $post->save();

          /* luego de guardar el post 
        vamos a asignarle las etiquetas 
        La relacion ya la tenemos definida */

        $post->tags()->attach($request->get('tags'));

        /*pasamos el mensaje de que la operacion fue satisfactoria*/

        return back()->with('flash', 'Tu publicación ha sido creada!');
    }
}
