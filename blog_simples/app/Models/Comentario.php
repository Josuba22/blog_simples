<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = ['postagem_id', 'user_id', 'conteudo'];

    //relacionamento com a postagem (pertence a)
    public function postagem()
    {
        return $this->belongsTo(Postagem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
