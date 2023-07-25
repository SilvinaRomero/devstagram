<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    // no ponemos el post_id ya que con la relacion se rellena automaticamente
    protected $fillable = [
        'user_id',
    ];
}
