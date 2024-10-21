<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'foto',
        'conteudo',
        'created_at',
        'updated_at'
    ];

    //relacionamento com comentários (um para muitos)
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
