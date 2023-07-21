<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Devstagram - @yield('titulo1')</title>
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">

        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black devstagram">DevStagram</h1>

            @auth

                <nav class="flex gap-2 items-center">
                    <a href="{{route('posts.create')}}" class="flex items-center gap-2 bg-gray-300 border hover:bg-gray-500 transition-colors p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer shadow-sm shadow-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                          </svg>
                          
                        Crear
                    </a>

                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('posts.index',auth()->user()->username)}}">
                        Hola: <span class="font-normal">{{ auth()->user()->username }}</span>
                    </a>

                    <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar Sessión</button>
                    </form>
                </nav>
            @endauth
            @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear cuenta</a>
                </nav>
            @endguest
        </div>
    </header>
    <main class="container mx-auto mt-10">

        <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>

        @yield('contenido')

    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        <span class="devstagram">DevStagram</span> - Todos los derechos reservados {{ now()->year }}
    </footer>

</body>

</html>
