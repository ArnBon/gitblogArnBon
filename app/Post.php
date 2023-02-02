<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; /*se coloco en el video 4*/


class Post extends Model
{
    protected $dates = ['published_at']; /*se coloco en el video 4 por defecto laravel trata los campos fechas como instancia de carbon*/
    protected $guarded = []; /**video 17 */

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

    //video 19 con query scopes cambiamos la consulta para que nos traiga las fechas no nulas
    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
        ->where('published_at','<=',Carbon::now())
        ->latest('published_at');
    }

}


