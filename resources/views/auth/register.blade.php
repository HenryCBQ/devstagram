@extends('layouts.app')

@section('titulo')
    Crear cuenta
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen del login">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST">
                @csrf <!--Protege los formularios contra ataques, envía un token oculto-->
                
                <div class="mb-3">
                    <label for="name" class="mb-2 uppercase text-gray-500 font-bold">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Tú nombre" class="border p-3 w-full rounded-lg
                        @error('name')
                            border-red-500
                        @enderror"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="username" class="mb-2 uppercase text-gray-500 font-bold">User name</label>
                    <input type="text" name="username" id="username" placeholder="Nombre de usuario" class="border p-3 w-full rounded-lg
                        @error('username')
                        border-red-500
                        @enderror"
                        value="{{ old('username') }}"
                    >
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="mb-2 uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" class="border p-3 w-full rounded-lg
                        @error('email')
                        border-red-500
                        @enderror"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password" class="mb-2 uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" name="password" id="password" placeholder="Contraseña" class="border p-3 w-full rounded-lg
                        @error('password')
                        border-red-500
                        @enderror"
                    >
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password_confirmation" class="mb-2 uppercase text-gray-500 font-bold">Repetir password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirma la contraseña" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Crear Cuenta" class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection