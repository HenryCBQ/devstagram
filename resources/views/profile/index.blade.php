@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('profile.store', auth()->user()) }}" method="POST" enctype="multipart/form-data" class="mb-2 block uppercase text-gray-500 font-bold">
                @csrf <!--Protege los formularios contra ataques, envía un token oculto-->
                
                <div class="mb-3">
                    <label for="username" class="mb-2 uppercase text-gray-500 font-bold">Nombre de usuario</label>
                    <input type="text" name="username" id="username" class="border p-3 w-full rounded-lg
                        @error('username')
                        border-red-500
                        @enderror"
                        value="{{ auth()->user()->username }}"
                    >
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="mb-2 uppercase text-gray-500 font-bold">Imagen de perfil</label>
                    <input type="file" name="image" id="image" class="border p-3 w-full rounded-lg"accept=".jpg, .jpeg, .png">
                </div>

                <input type="submit" value="Guardar" class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection