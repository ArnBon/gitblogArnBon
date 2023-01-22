<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//video 3
// Route::get('posts', function(){
//     return App\Post::all();
// }); //esto fue modificado por el de abajo

// Route::get('/', function(){
//     $posts = App\Post::all();
//     return view('welcome', compact('posts'));
// }); // este fue modificado por el de abajop

Route::get('/', function(){
    $posts = App\Post::latest('published_at')->get();
    return view('welcome', compact('posts'));
});

Route::get('posts', function(){
    return App\Post::all();
}); 
//*fin video 3*


