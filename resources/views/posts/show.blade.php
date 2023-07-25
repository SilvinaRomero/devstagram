@extends('layouts.app')

@section('titulo1')
    {{ $post->titulo }}
@endsection
@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex gap-6">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3 flex items-center gap-2">
                @auth

                <livewire:like-post />

                {{-- $post Modelo, puedo acceder a funciones del modelo --}}
                    @if ($post->checkLike(auth()->user()))
                    <form action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="my-4">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>

                    </form>
                    @else
                        <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>

                        </form>
                    @endif
                @endauth
                <p class="font-bold">
                    {{$post->likes->count()}} 
                    <span class="font-normal">Likes</span>
                </p>
            </div>

            <div>
                <a href="{{ route('posts.index', $post->user->username) }}" class="font-bold pb-2">
                    <p class="font-bold">{{ $post->user->username }}</p>
                </a>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>

                @auth
                    @if ($post->user_id === auth()->user()->id)
                        <form action="{{ route('post.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar Publicación"
                                class="bg-red-500 hover:bg-red-800 p-2 rounded text-white font-bold mt-4 cursor-pointer text-center">
                        </form>
                    @endif

                @endauth
            </div>
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white mb-5 p-5 pt-2">
                @auth
                    <p class="text-xl font-bold text-center mb-4 pb-5">
                        Agrega un Nuevo Comentario
                    </p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <form action="{{ route('comentarios.store', ['user' => $user, 'post' => $post]) }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Comentar
                                Publicación</label>
                            <textarea id="comentario" name="comentario" type="text" placeholder="Agregue un comentario"
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror" value=""></textarea>

                            @error('comentario')
                                <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth

            </div>

            <div class="bg-white shadow mb-5 max-h-96">
                @if ($post->comentarios->count() > 0)
                   
                    @foreach ($post->comentarios as $comentario)
                        <div class="border-gray-300 p-5 border-b">
                            <a href="{{ route('posts.index', $comentario->user) }}"
                                class="font-bold pb-2">{{ $comentario->user->username }}</a>
                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600 uppercase text-sm text-center font-bold p-5">No hay Comentarios</p>
                @endif
            </div>
        </div>
    </div>
@endsection
