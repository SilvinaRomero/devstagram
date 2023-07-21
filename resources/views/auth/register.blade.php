@extends('layouts.app')
@section('titulo1')
Regístrate en DevStagram
@endsection
@section('titulo')
    Regístrate en <span class="devstagram">DevStagram</span>
@endsection
@section('contenido')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-5/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro usuario" class="rounded-lg">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                    {{-- name --}}
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input id="name" name="name" type="text" placeholder="Tu Nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}">

                    @error('name')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ $message }}</p>
                    @enderror
                </div>
                {{-- username --}}
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') }}">
                    @error('username')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ $message }}</p>
                    @enderror
                </div>
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
                {{-- password confirmacion --}}
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Repite tu password" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>

    </div>
@endsection
