<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('post.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen publicación {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <!--Paginación-->
        <div class="my-5">
            {{ $posts->links() }}
        </div>

    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones aún</p>
    @endif
</div>