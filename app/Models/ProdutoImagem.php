<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoImagem extends Model
{
    // Corrigindo o nome da tabela explicitamente
    protected $table = 'produto_imagens';

    protected $fillable = [
        'produto_id',
        'caminho' // ou 'imagem_path', dependendo do nome da coluna
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
