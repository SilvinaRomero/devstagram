<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    public function store(User $user){
        //attach cuando relacionas a la tabla con la misma tabla
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(Request $request,User $user){
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
