<?php

namespace App\Http\Controllers\Admin;
use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index()
    {
         //$posts = Post::all();
        // return view('admin.posts.index', compact('posts'));
       /**  para el video 50 mostrar los posts dependiendo del usuario conectado es decir que un usuario vea sus propios post*/

      // $posts = Post::where('user_id', auth()->id())->get(); //trae los posts del usuario actualmente autenticado
       //$posts = auth()->user()->posts; //trae al usuario actualmente autenticado a traves de la relacion del post 

        // if (auth()->user()->hasRole('Admin')) {
        //     $posts = Post::all();
        // } 
        // else
        // {
        //     $posts = auth()->user()->posts;
        // }


       $posts = Post::allowed()->get();       
       return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', New Post);
        $this->validate($request, ['title' => 'required|min:3']); //validamos

        // $post = Post::create( $request->only('title') );
        $post = Post::create($request->all() );        

        /**Nota: si queremos hacer esto de forma automatica podemos sobreescribir el metodo create que esta con el Post::create cortamos 
         * $post->url = str_slug($request->get('title')) . "-{$post->id}"; //concatenamos el - y el id del post
        $post->save();
        y lo pegamos en el modelo en el metodo static
        */

        return redirect()->route('admin.posts.edit', $post); //redireccionamos
    }

    public function edit(Post $post)
    {

        $this->authorize('update', $post);
        /**como 1er parametro recibe la accion que queremos autorizar
         * que es equivalente al nombre del metodo que tenemos en
         * la politica en este caso el view.
         * 
         * como 2do parametro le pasasmos el post que quremos 
         * autorizar
         */

         return view('admin.posts.edit', [            
            'post'       => $post,
            'tags'       => Tag::all(),
            'categories' => Category::all()
         ]);   
        
    }

    public function update(Post $post, StorePostRequest $request) 
    {  
        $this->authorize('update', $post);

        $post->update($request->all());
        $post->syncTags($request->get('tags'));
        return redirect()->route('admin.posts.edit', $post)->with('flash', 'La publicación ha sido actualizada !!');
    }

    public function destroy(Post $post)
    {
        //$post->tags()->detach(); //quitara las etiquetas asignadas al post que se este eliminando

        // foreach ($post->photos as $photo)
        // {
        //     $photo->delete();
        // } PERO LO HACEMOS DE OTRA FORMA es decir asi:

        // $post->photos->each(function($photo){
        //     $photo->delete();
        // }); PERO TAMBIEN LO PODEMOS HACER DE UNA FORMA MAS CORTA Y OPTIMA SEGUN ME CONVENGA

        //$post->photos->each->delete();
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()
            ->route('admin.posts.index')
            ->with('flash', 'La publicación ha sido eliminada !!');
    }
}