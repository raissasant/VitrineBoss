<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Plataforma;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria', 'plataforma')->paginate(10);
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
            'preco' => 'nullable|numeric',
            'link_afiliado' => 'required',
            'plataforma_id' => 'required',
            'categoria_id' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dados = $request->only([
            'nome',
            'descricao',
            'preco',
            'link_afiliado',
            'plataforma_id',
            'categoria_id',
        ]);

        $dados['slug'] = Str::slug($request->nome);
        $slugOriginal = $dados['slug'];
        $contador = 1;
        while (Produto::where('slug', $dados['slug'])->exists()) {
            $dados['slug'] = $slugOriginal . '-' . $contador++;
        }

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('produtos', 'public');
            $dados['imagem_path'] = $path;
        }

        Produto::create($dados);

        return redirect()->route('admin.produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    // ✅ MÉTODO FALTANTE ADICIONADO AQUI
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
            'preco' => 'nullable|numeric',
            'link_afiliado' => 'required',
            'plataforma_id' => 'required',
            'categoria_id' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dados = $request->only([
            'nome',
            'descricao',
            'preco',
            'link_afiliado',
            'plataforma_id',
            'categoria_id',
        ]);

        $novoSlug = Str::slug($request->nome);
        if ($novoSlug !== $produto->slug) {
            $slugOriginal = $novoSlug;
            $contador = 1;
            while (Produto::where('slug', $novoSlug)->where('id', '!=', $produto->id)->exists()) {
                $novoSlug = $slugOriginal . '-' . $contador++;
            }
            $dados['slug'] = $novoSlug;
        }

        if ($request->hasFile('imagem')) {
            if ($produto->imagem_path && Storage::disk('public')->exists($produto->imagem_path)) {
                Storage::disk('public')->delete($produto->imagem_path);
            }

            $path = $request->file('imagem')->store('produtos', 'public');
            $dados['imagem_path'] = $path;
        }

        $produto->update($dados);

        return redirect()->route('admin.produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        if ($produto->imagem_path && Storage::disk('public')->exists($produto->imagem_path)) {
            Storage::disk('public')->delete($produto->imagem_path);
        }

        $produto->delete();

        return redirect()->back()->with('success', 'Produto excluído!');
    }
}
