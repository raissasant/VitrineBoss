<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Plataforma;
use App\Models\ProdutoImagem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria', 'plataforma', 'imagens')
            ->orderByDesc('id') // 🔥 novos primeiro
            ->paginate(10);

        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $plataformas = Plataforma::all();
        return view('admin.produtos.create', compact('categorias', 'plataformas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable|string',
            'preco' => 'nullable|string', // Alterado para string
            'link_afiliado' => 'required',
            'plataforma_id' => 'required',
            'categoria_id' => 'required',
            'imagens' => 'nullable|array',
            'imagens.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dados = $request->only([
            'nome', 'descricao', 'preco', 'link_afiliado', 'plataforma_id', 'categoria_id'
        ]);

        // Slug único
        $dados['slug'] = Str::slug($request->nome);
        $slugOriginal = $dados['slug'];
        $contador = 1;
        while (Produto::where('slug', $dados['slug'])->exists()) {
            $dados['slug'] = $slugOriginal . '-' . $contador++;
        }

        $produto = Produto::create($dados);

        // Upload de imagens
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('produtos', 'public');
                $produto->imagens()->create(['caminho' => $path]);
            }
        }

        return redirect()->route('admin.produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        $plataformas = Plataforma::all();
        return view('admin.produtos.edit', compact('produto', 'categorias', 'plataformas'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable|string',
            'preco' => 'nullable|string', // Alterado para string
            'link_afiliado' => 'required',
            'plataforma_id' => 'required',
            'categoria_id' => 'required',
            'imagens' => 'nullable|array',
            'imagens.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dados = $request->only([
            'nome', 'descricao', 'preco', 'link_afiliado', 'plataforma_id', 'categoria_id'
        ]);

        // Slug único ao atualizar
        $novoSlug = Str::slug($request->nome);
        if ($novoSlug !== $produto->slug) {
            $slugOriginal = $novoSlug;
            $contador = 1;
            while (Produto::where('slug', $novoSlug)->where('id', '!=', $produto->id)->exists()) {
                $novoSlug = $slugOriginal . '-' . $contador++;
            }
            $dados['slug'] = $novoSlug;
        }

        $produto->update($dados);

        // Upload de novas imagens
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('produtos', 'public');
                $produto->imagens()->create(['caminho' => $path]);
            }
        }

        return redirect()->route('admin.produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        foreach ($produto->imagens as $imagem) {
            Storage::disk('public')->delete($imagem->caminho);
            $imagem->delete();
        }

        $produto->delete();

        return redirect()->back()->with('success', 'Produto excluído!');
    }

    public function destroyImage(Produto $produto, ProdutoImagem $imagem)
    {
        if ($imagem->produto_id == $produto->id) {
            Storage::disk('public')->delete($imagem->caminho);
            $imagem->delete();
            return back()->with('success', 'Imagem removida com sucesso.');
        }

        return back()->with('error', 'Imagem não encontrada ou não pertence ao produto.');
    }
}
