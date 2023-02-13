<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; /*se coloco en el video 4*/


class Post extends Model
{
    protected $dates = ['published_at']; /*se coloco en el video 4 por defecto laravel trata los campos fechas como instancia de carbon*/

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($post){
            $post->tags()->detach(); 
            $post->photos->each->delete();
        });

        /**cuando estemos eliminando un posts se recibe por aqui luego elimina la relacion de los tags y finalmente borra la foto 
         * por cada foto que se elimine se estara escuchando el evento deleting y las eliminamos del almacenamiento        */
    }
    
    protected $fillable = [
         'title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id']; 

    public function getRouteKeyName()
    {
        return 'url';
    }
    
    /*creado en el video 5*/
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
        ->where('published_at','<=',Carbon::now())
        ->latest('published_at');
    }

    public function isPublished()
    {
        return ! is_null($this->published_at) && $this->published_at < today();
    }

    public static function create(array $attributes = [])
    {
        // $post = static::query()->create($attributes); //esto devuelve el post recien creado
        // // $post->url = str_slug($request->get('title')) . "-{$post->id}"; //concatenamos el - y el id del post sustituimos ($request->get('title') por:
        // $post->url = str_slug($attributes['title']) . "-{$post->id}"; 
        // $post->save(); // viene de PostsController de la administración
        //return $post;
/*Nota: solo queremos que nos agregue el id  y cuando se repita una url en caso contrario no agregamos nada:*/
        $post = static::query()->create($attributes); //creamos el post solo con el titulo
        $post->generateUrl();
        return $post;
    }

    public function generateUrl()
    {
        $url = str_slug($this->title); //generamos la url amigable basada en ese titulo (en caso que el post se cree por 1era vez)
        if ($this->whereUrl($url)->exists()) { //verificamos si existe otro post con esa url 
            $url = "{$url}-{$this->id}"; //si existe le agregamos el post recien creado
        }
        $this->url = $url; //asignamos esa url al post (en caso de duplicacion del titulo del post)
        $this->save();
    }



    // public function setTitleAttribute($title)
    // {
    //     $this->attributes['title'] = $title;

    //     //$url = str_slug($title);
    //     // $duplicateUrlCount = Post::where('url', 'LIKE', "{$url}%")->count();

    //     // if($duplicateUrlCount)
    //     // {
    //         // $url .= "-" . ++$duplicateUrlCount;
    //     //    $url .= "-" . uniqid();
    //     //}
    //         //OTRA OPCION SERIA UTILIZAR UN WHILE:

    //         $originalUrl = $url = str_slug($title);
    //         $count = 1;

    //         while (Post::where('url', $url)->exists()) {
    //             $url = "{$originalUrl}-" . ++$count;
    //         }

    //     $this->attributes['url'] = str_slug($url);
    // }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }

    public function setcategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
                                            ? $category
                                            : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function($tagIds){
            return Tag::find($tagIds) ? $tagIds : Tag::create(['name' => $tagIds])->id;
        });
        return $this->tags()->sync($tagIds);
    }



}


