<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Clique;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    /**
     * Exibe a vitrine pública de produtos.
     */
    public function index(Request $request)
    {
        $query = Produto::with(['plataforma', 'categoria', 'imagens']); // ✅ adicionamos imagens

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('plataforma_id')) {
            $query->where('plataforma_id', $request->plataforma_id);
        }

        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        $produtos = $query->paginate(9);
        $categorias = \App\Models\Categoria::all();
        $plataformas = \App\Models\Plataforma::all();

        return view('home', compact('produtos', 'categorias', 'plataformas'));
    }

    /**
     * Exibe os detalhes de um produto específico.
     */
    public function show($slug)
    {
        $produto = Produto::with('imagens', 'categoria', 'plataforma')->where('slug', $slug)->firstOrFail();
        return view('produto', compact('produto'));
    }

    /**
     * Redireciona para o link de afiliado e registra o clique.
     */
    public function go($slug, Request $request)
    {
        $produto = Produto::where('slug', $slug)->firstOrFail();

        Clique::create([
            'produto_id' => $produto->id,
            'ip' => $request->ip(),
            'origem' => $request->header('referer'),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->away($produto->link_afiliado);
    }
}
