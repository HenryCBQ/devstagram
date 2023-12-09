<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //Llama la vista automáticamente cuando se llama al controlador
    public function __invoke(){
        //Obtener id de los usuarios que sigue
        $following = auth()->user()->following->pluck('id')->toArray();
        //Obtener los posts de los usuarios que sigue
        $posts = Post::whereIn('user_id', $following)->latest()->paginate(20);
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
