@extends('layouts.app')

@section('titulo1')
    Inicia Sesión en DevStagram
@endsection
@section('titulo')
    Inicia Sesión en <span class="devstagram">DevStagram</span>
@endsection
@section('contenido')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-5/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login usuario" class="rounded-lg">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                @if (session('mensaje'))
                {{-- <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ $mensaje }}</p> --}}
                <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ session('mensaje') }}</p>
                @endif

                {{-- email --}}
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" name="email" type="email" placeholder="Tu Email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ $message }}</p>
                    @enderror
                </div>
                {{-- password --}}
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input id="password" name="password" type="password" placeholder="Tu Password de registro"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input id="remember" type="checkbox" name="remember"><label for="remember" class="text-gray-500 text-sm"> Mantener mi sesión abierta</label>
                </div>


                <input type="submit" value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>

    </div>
@endsection
