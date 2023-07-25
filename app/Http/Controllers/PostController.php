<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {
        // dd($user->id);
        $posts = Post::where('user_id',$user->id)->latest()->paginate(8);
        // $posts = Post::where('user_id',$user->id)->simplePaginate(5);
        // me ahorro filtrar los posts gracias a la relacion. en la vista usa $user->posts !pero no se pueden paginar      
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'image' => 'required',
        ]);
        // si pasa la validacion sigue ->
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'image' => $request->image,
        //     'user_id'=> auth()->user()->id
        // ]);
        // otra forma de crear registros

        // $post = new Post;
        // $post->titulo =$request->titulo;
        // $post->descripcion =$request->descripcion;
        // $post->image =$request->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // tercera forma para guardar registros cuando las tablas estan relacionadas
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user,Post $post)
    {
        // dd($user,$post);
        return view('posts.show',['post'=>$post,'user'=>$user]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();

        //Eliminar la imagen del servidor
        $imagen_path = public_path('uploads/'.$post->image);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }



        return redirect()->route('posts.index',auth()->user()->username);
    }
}
