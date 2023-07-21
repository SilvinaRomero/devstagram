<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index () 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validacion
        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        // crear registro
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            // si no viene si el hash en User
            // 'password' => Hash::make($request->password)
        ]);

        // Autenticar
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // Otra forma de autenticar
        auth()->attempt($request->only('email','password'));


        //Redireccionar
        return redirect()->route('posts.index');

    }
}
