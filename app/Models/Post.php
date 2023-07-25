<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comentario;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'image'
    ];

    // relacionar el  Post conun usuario Belong to (el usuario dueño de este post)
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name','username']); // filtramos solo para que nos devuelva dos columnas
    }

    // un post puede tener multiples comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    // un post puede tener muchos likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // evitar duplicados en los likes
    public function checkLike(User $user)
    {
        // ->likes-> hace referencia a la relacion, no a la funcion anterior
        return $this->likes->contains('user_id',$user->id);
    }

}
