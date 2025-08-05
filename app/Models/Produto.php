<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
    {
    protected $fillable = [
        'nome',
        'descricao',
        'slug',
        'link_afiliado',
        'imagem_path', // novo campo
        'preco',
        'categoria_id',
        'plataforma_id',
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function plataforma()
    {
        return $this->belongsTo(Plataforma::class);
    }

    public function cliques()
    {
        return $this->hasMany(Clique::class);
    }
}
