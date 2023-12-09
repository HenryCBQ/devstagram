<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller
{
    //Seguir a un usuario
    public function store(User $user)
    {
        //Attach para crear se utiliza cuando hay una relación de muchos a muchos y utiliza dos llaves foráneas de la misma tabla
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    //Dejar de seguir a un usuario
    public function destroy(User $user){
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
