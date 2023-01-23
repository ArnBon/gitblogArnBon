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

/**comentado en el video 11 */
// Route::get('/', function(){
//     $posts = App\Post::latest('published_at')->get();
//     return view('welcome', compact('posts'));
// });
/**fin comentado en el video 11 */

Route::get('posts', function(){
    return App\Post::all();
}); 
//*fin video 3*

/**video 8 */
// Route::get('admin', function(){
//     return view('admin.dashboard');
// });
/**fin video 8 */

/*video 9*/
//Route::auth(); se reemplaza con el contenido del archivo Router.php el de abajo
// Authentication Routes... esto se hace para personalizar el login y registro//
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
/**fin video 9 */

/** Video 10 se cambia admin por home y se agrega un middleware referencia video 8*/
// Route::get('home', function(){
//     return view('admin.dashboard');
// })->middleware('auth');
/**fin video 10 */

/*video 11*/
Route::get('/', 'PagesController@home');
Route::get('home', 'HomeController@index');
// Route::get('admin/posts', 'Admin\PostsController@index');
/**despues vino la creacion de los grupos de rutas */
Route::group([
'prefix'     => 'admin',
'namespace'  => 'Admin',
'middleware' => 'auth'],
function(){
    Route::get('posts', 'PostsController@index');
});
/**fin video 11 */

