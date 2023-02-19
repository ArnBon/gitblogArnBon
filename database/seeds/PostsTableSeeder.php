<?php

use App\Post;
use App\Category;
use App\Tag; 
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**Archivo creado en el video 6 */

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');
        Post::truncate();
        Category::truncate();
        Tag::truncate(); //agregado video 7

        $category = new Category;
        $category->name = "Categoria 1";
        $category->save();


        $category = new Category;
        $category->name = "Categoria 2";
        $category->save();


        $category = new Category;
        $category->name = "Categoria 3";
        $category->save();

        $category = new Category;
        $category->name = "Categoria 4";
        $category->save();


        $post = new Post;
        $post->title = "Mi primer post";
        $post->url = str_slug("Mi primer post");              
        $post->excerpt = "Extracto de mi primer post";
        $post->body = "<p>Contenido de mi primer post</p>";
        $post->published_at = Carbon::now()->subDays(4);
        $post->category_id = 4;
        $post->user_id = 1;

        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Etiqueta 4']));//agregado video 7

		$post = new Post;
        $post->title = "Mi segundo post";
        $post->url = str_slug("Mi segundo post");
        $post->excerpt = "Extracto de mi segundo post";
        $post->body = "<p>Contenido de mi segundo post</p>";
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 3;
        $post->user_id = 1;

        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Etiqueta 3']));//agregado video 7

        $post = new Post;
        $post->title = "Mi tercer post";
        $post->url = str_slug("Mi tercer post");
        $post->excerpt = "Extracto de mi tercer post";
        $post->body = "<pContenido de mi tercer post></p>";
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 2;
        $post->user_id = 2;

        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Etiqueta 2']));//agregado video 7
        
        $post = new Post;
        $post->title = "Mi cuarto post";
        $post->url = str_slug("Mi cuarto post");
        $post->excerpt = "Extracto de mi cuarto post";
        $post->body = "<p>Contenido de mi cuarto post</p>";
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 1;
        $post->user_id = 2;

        $post->save(); 

        $post->tags()->attach(Tag::create(['name' => 'Etiqueta 1']));//agregado video 7
        
    }
}
