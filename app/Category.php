<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getRouteKeyName()
    {
        return 'url';
    }

    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    /**vamos a crear un accesor y un mutador  */

    // public function getnameAttribute($name)
    // {
    //     return str_slug($name);
    // }

    // public function setnameAttribute($name)
    // {
    //     $this->attributes['name'] = str_slug($name);
    // }

    public function setnameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
 

    
}
