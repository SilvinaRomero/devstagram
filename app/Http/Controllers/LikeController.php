<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Request $request,Post $post)
    {
        // dd('controlador');  //despues de liverwire, ya no pasa por aqui parece
        // al crear la relacion no neceitamos pasar el $post->id
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Request $request,Post $post)
    {
        $request->user()->likes()->where('post_id',$post->id)->delete();
        return back();
    }
}
