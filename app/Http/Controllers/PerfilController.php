<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //Proteger las rutas
    public function __construct(){
        $this->middleware('auth');
    }

    //Mostrar el formulario
    public function index(){
        return view('profile.index');
    }

    public function store(Request $request){
        $this->validate($request, [
            //Se agrega en el unique el id del usuario para que reconozca que no hubo cambios
            'username' => ['required', 'min:4', 'max:20', 'unique:users,username,'.auth()->user()->id],
        ]);

        if($request->image){
            $imagen = $request->file('image');
            //Crear nombre de imagen único
            $nameImage = Str::uuid() . "." . $imagen->extension();
            
            //Utilizar intervention image
            $imageServer = Image::make($imagen);
            //Cortar la a imagen de 1000px por 1000px
            $imageServer -> fit(1000, 1000);
            //Crear ubicación del archivo
            $imagePath = public_path('profile') . '/' . $nameImage;
            //Guardar imagen
            $imageServer->save($imagePath);
        }

        //Guardar cambios
        //Buscar al usuario
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $nameImage ?? auth()->user()->image ?? null;
        $user->save();

        //Redireccionar al usuario
        return redirect()->route('posts.index', $user->username);
    }
}
