@extends('layouts.app')

@section('titulo1')
    Editar Perfil
@endsection
@section('titulo')
    Editar Perfil: {{ auth()->user()->name }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white p-6">
            <form action="{{ route('perfil.store') }}" enctype="multipart/form-data" method="POST" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu Nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}">

                    @error('username')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfl</label>
                    <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png"
                        class="border p-3 w-full rounded-lg @error('image') border-red-500 @enderror"
                        value="">

                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" name="email" type="email" placeholder="Tu Email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"value="{{ auth()->user()->email }}">
                    @error('email')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-1 text-left">{{ $message }}</p>
                    @enderror
                </div>
                 {{-- password anterior --}}
                 <div class="mb-5">
                    <label for="password1" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input id="password1" name="password1" type="password" placeholder="Tu Password de actual"
                        class="border p-3 w-full rounded-lg @error('password1') border-red-500 @enderror">
                    @error('password1')
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


                <input type="submit" value="GUARDAR CAMBIOS"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
