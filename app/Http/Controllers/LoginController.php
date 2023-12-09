<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Mostrar formulario para iniciar sesión
    public function index(){
        return view('auth.login');
    }

    //Validación formulario incio de sesión
    public function store(Request $request){
        //Validar formulario
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Si las credenciales son erroneas
        if(!auth()->attempt($request->only('email', 'password'))){
            //Retornar mensaje de error, el back retorna al usuario a la página anterior enviando el mensaje con with
            return back()->with('mensaje', 'Credenciales no válidas');
        }
        //Si es exitoso reedireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
