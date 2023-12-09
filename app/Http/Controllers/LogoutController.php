<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function store(){
        //Cerrar la sesión
        auth()->logout();
        return redirect()->route('login');
    }
}
