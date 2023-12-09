<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, User $user, Post $post){ //User no se utiliza, sólo para mantener las urls consistentes en el router
        //Validar formularios
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);

        //Almacenar comentario
        Comment::create([
            'user_id' => auth()->user()->id, //Acceder al usuario que está comentando
            'post_id' => $post->id,
            'comment' => $request->comment
        ]);

        //Redireccionar y mandar mensaje la usuario
        return back()->with('message', 'Comentario realizado correctamente');
    }
}
