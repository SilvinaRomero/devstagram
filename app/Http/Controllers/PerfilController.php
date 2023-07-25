<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\Facades\Image;
use App\Models\User;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,' . auth()->user()->id,'email'],
        ]);

        if($request->password1 != ''){
            $this->validate($request, [
                'password' => 'required'
            ]);
        }
        
        if ($request->image) {
            $imagen = $request->file('image');

            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
            $imagenServidor = Image::make($imagen);

            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
            // ImagenController
            // return response()->json(['image' => $nombreImagen]);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->image = $nombreImagen ?? auth()->user()->image ?? null;
        $usuario->email = $request->email;

        if (Hash::check($request->password1, auth()->user()->password)) {
            $usuario->password = $request->password;
        }



        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index',$usuario->username);

    }
}
