<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Relación One to Many (Uno a muchos) con posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Relación One to Many (Uno a muchos) con like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario, al salirse de las convenciones de laravel se debe especificar la tabla y las columnas
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //Los que sigue el usuario
    public function following(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    //Validar si el usuario sigue a otro usuario
    public function isFollowing(User $user)
    {
        //return $this->followers()->contains($user->id);
        return $this->followers()->where('follower_id', $user->id)->exists();
    }
}
