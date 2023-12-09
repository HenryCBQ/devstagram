<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    //Almacena los like
    public function store(Request $request, Post $post){
        //Giardar like
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);
        //Retornar a la misma página
        return back();
    }

    public function destroy(Request $request, Post $post){
        //Eliminar like
        $request->user()->likes()->where('post_id', $post->id)->delete();
        //Retornar a la misma página
        return back();
    }
}
