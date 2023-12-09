@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    <!--Agregar componente, se le debe pasar la variable posts que viene del controlador-->
    <!--Recordar que la etique manda a llamar al constructor del componente-->
    <x-list-posts :posts="$posts"/>
@endsection
