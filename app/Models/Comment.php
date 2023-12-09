<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    //Crear relación inversa entre usuario y comentario. Cada comentario pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
