<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //Crear relación inversa con usuario (One To Many (Inverse) / Belongs To)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Crear relación de uno -muchos, un post puede tener muchos comentarios
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    //Crear relación de uno - muchos, un post puede tener muchos likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Validar si un usuario ya dio like a un post
    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
