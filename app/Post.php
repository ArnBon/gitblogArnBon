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

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['url'] = str_slug($title);
    }

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


