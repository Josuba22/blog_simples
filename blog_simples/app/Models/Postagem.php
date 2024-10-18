<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'foto', 'conteudo'];

    //relacionamento com comentários (um para muitos)
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
