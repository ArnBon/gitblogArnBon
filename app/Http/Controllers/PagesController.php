<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {  
         $query = Post::published();

        if(request('month')) {
            $query->whereMonth('published_at', request('month'));
        }

        if(request('year')) {
            $query->whereYear('published_at', request('year'));
        }            
        $posts = $query->paginate(2); 
        return view('pages.home', compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
       // $archive = Post::published()->byYearAndMonth(); 

         $archive = Post::selectRaw('year(published_at) year')
                    ->selectRaw('month(published_at) month')
                    ->selectRaw('monthname(published_at) monthname')
                    ->selectRaw('count(*) posts')
                    ->groupBy('year', 'month', 'monthname')
                    //->orderBy('published_at') //da error de violacion de reglas o algo asi por algo del published_at
                    ->orderBy('month')// asi si funciona porque no encuentra published_at
                    ->get();
                    

        return view('pages.archive', [
            'authors' => User::latest()->take(4)->get(),
            'categories' => Category::take(7)->get(),
            'posts' => Post::latest('published_at')->take(5)->get(),
            'archive' => $archive
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }


}
