@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">

        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            
            <div class="flex items-center gap-2">
                @auth
                    <!--Se agrega componente livewire, para agregar like o quitarlo, sedeb pasar el post-->
                    <livewire:like-post :post="$post"/>
                @endauth
            </div>
            
            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p>{{ $post->descripcion }}</p>
            </div>

            <!--Sólo para usuarios logueados y el propietario de la publicación-->
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE') <!--Esta opción se conoce como Methode Spoofing-->
                        @csrf
                        <input type="submit" value="Eliminar publicación" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer">
                    </form>
                @endif
            @endauth
        </div>
        
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                <!--Sólo para usuarios logueados-->
                @auth
                    <p class="text-xl font-bold text-center mb-2">Agregar un comentario</p>

                    @if (session('message'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{ route('comment.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="comment" class="mb-2 uppercase text-gray-500 font-bold">Comentario</label>
                            <textarea name="comment" id="comment" placeholder="Agregar comentario" 
                                class="border p-3 w-full rounded-lg @error('comment') border-red-500 @enderror"
                            ></textarea>
                            @error('comment')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar" class="bg-sky-500 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded-lg">
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comment->count())
                        @foreach ($post->comment as $comm)
                            <div class="p-5 border-gray-500 border-b">
                                <a href="{{ route('posts.index', $comm->user) }}" class="font-bold">{{ $comm->user->username }}</a>
                                <p>{{ $comm->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $comm->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p>Sin comentarios aún. ¡Sé el primero!</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection