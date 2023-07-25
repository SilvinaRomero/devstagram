<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\User;
use App\Models\Post;

class ComentarioController extends Controller
{
    public function store(User $user, Post $post, Request $request)
    {
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        Comentario::create([
            'comentario' => $request->comentario,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return back()->with('mensaje','Comentario realizado correctamente');
    }
}
