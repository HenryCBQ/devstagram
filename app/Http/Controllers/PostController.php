<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Proteger todo el controlador, el usuario debe estar logueado
    public function __construct(){
        //Se pueden agregar excepciones a ciertos métodos
        $this->middleware('auth')->except(['index', 'show']);
    }

    //Mostrar perfil del usuario logueado
    public function index(User $user){
        //Importante especificar el método get para que traiga los registros de la DB
        $posts = Post::where('user_id', $user->id)->latest()->paginate(8); //Pagitation agrega la paginación, recibe cuantos registros mostrar por pagina

        return view('layouts.dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //Vista formulario para crear una publicación
    public function create(){
        return view('posts.create');
    }

    //Crear una publicación
    public function store(Request $request){
        //Validar el formulario
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:1000',
            'imagen' => 'required'
        ]);

        //Almacenar la publicación, forma sin relaciones entre modelos
        /*
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
        */

        //Alamcenar publicación usando relaciones entre modelos
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        //Reedirigir al usuario a sus posts
        return redirect()->route('posts.index', auth()->user()->username);
    }

    //Mostrar una publicación
    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    //Eliminar publicación
    public function destroy(Post $post){
        //Llamar al policy para verificar si el usuario puede eliminar la publicación
        $this->authorize('delete', $post);
        //Eliminar la publicación de la DB
        $post->delete();
        
        //Eliminar la imagen de la publicación
        $imagePath = public_path('uploads/'. $post->imagen);
        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        //Redirigir al usuario a sus posts
        return redirect()->route('posts.index', auth()->user()->username);
    }
}