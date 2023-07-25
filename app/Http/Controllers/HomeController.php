<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {
        //Obtener a quienes seguimos
        $ids = auth()->user()->followins->pluck('id')->toArray(); //pluck para filtrar

        $posts = Post::whereIn('user_id',$ids)->latest()->paginate(20);

        return view('home',[
            'posts' => $posts,
        ]);
    }
}
