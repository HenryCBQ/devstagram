<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //Subir imágenes
    public function store(Request $request){
        $imagen = $request->file('file');
        //Crear nombre de imagen único
        $nameImage = Str::uuid() . "." . $imagen->extension();
        
        //Utilizar intervention image
        $imageServer = Image::make($imagen);
        //Cortar la a imagen de 1000px por 1000px
        $imageServer -> fit(1000, 1000);
        //Crear ubicación del archivo
        $imagePath = public_path('uploads') . '/' . $nameImage;
        //Guardar imagen
        $imageServer->save($imagePath);
        return response()->json(['imagen' => $nameImage]);
    }
}
