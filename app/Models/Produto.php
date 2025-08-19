<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /**
     * Campos permitidos para atribuição em massa.
     */
    protected $fillable = [
        'nome',
        'descricao',
        'slug',
        'link_afiliado',
        'imagem_path',
        'preco',            // agora pode ser string OU número
        'categoria_id',
        'plataforma_id',
    ];

    /**
     * Opcional: incluir o accessor no array/JSON automaticamente.
     * Não interfere nas views, mas ajuda em APIs.
     */
    protected $appends = [
        'preco_formatado',
    ];

    /* =======================
     |        Relações
     ======================= */

    public function imagens()
    {
        return $this->hasMany(\App\Models\ProdutoImagem::class);
    }

    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }

    public function plataforma()
    {
        return $this->belongsTo(\App\Models\Plataforma::class);
    }

    public function cliques()
    {
        return $this->hasMany(\App\Models\Clique::class);
    }

    /* =======================
     |       Accessors
     ======================= */

    /**
     * Retorna o preço pronto para exibição.
     * - Se já vier como "R$ 39,90", mantém igual.
     * - Se vier numérico (39.9, "39.90"), formata para "R$ 39,90".
     * - Se vier string com símbolos, tenta normalizar.
     * - Se vazio/null, retorna null.
     */
    public function getPrecoFormatadoAttribute()
    {
        $preco = $this->preco;

        // vazio ou null
        if ($preco === null) {
            return null;
        }
        if (is_string($preco) && trim($preco) === '') {
            return null;
        }

        // já formatado com "R$"
        if (is_string($preco) && str_contains($preco, 'R$')) {
            return $preco;
        }

        // numérico puro (int/float ou string numérica)
        if (is_numeric($preco)) {
            return 'R$ ' . number_format((float) $preco, 2, ',', '.');
        }

        // string tipo "39,90" ou "39.90" ou "1.234,56"
        if (is_string($preco)) {
            // remove tudo que não é dígito, vírgula ou ponto
            $raw = preg_replace('/[^\d,\.]/', '', $preco);

            // trata milhar e separador decimal pt-BR
            // ex.: "1.234,56" -> remove milhar (.)
            $raw = str_replace('.', '', $raw);
            // ex.: "1234,56" -> vírgula decimal vira ponto
            $raw = str_replace(',', '.', $raw);

            if ($raw !== '' && is_numeric($raw)) {
                return 'R$ ' . number_format((float) $raw, 2, ',', '.');
            }

            // se não conseguiu normalizar, devolve como veio
            return $preco;
        }

        // tipo inesperado
        return null;
    }
}
