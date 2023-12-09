<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    //Request tipo post para crear nuevo usuario
    public function store(Request $request){
        //Validar formulario
        $this->validate($request, [
            'name' => 'required|max:30|regex:/^[a-zA-ZÁÉÍÓÚÜáéíóúü\s]+$/u',
            'username' => 'required|max:30|unique:users|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|max:30|unique:users|email|max:60',
            'password' => 'required|max:60|min:8|confirmed'
        ]);

        //Crear usuario. Laravel ya tiene todas las operaciones incluidas
        User::create([
            'name' => $request->name,
            'username' => Str::lower($request->username), //Todos los nombre de usuario deben ir en minúscula
            'email' => $request->email,
            'password' => Hash::make($request->password) //Hashear la contraseña
        ]);

        //Autenticar al usuario una vez creada su cuenta
        auth()->attempt($request->only('email', 'password'));

        //Reedireccionar al usuario
        return redirect()->route('posts.index');
    }
}
