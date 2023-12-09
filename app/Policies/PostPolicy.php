<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    //Método que determina que sólo el usuario que es propietario de la publicación puede eliminarla
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
