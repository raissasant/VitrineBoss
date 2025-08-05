<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nome' => 'required|string|max:100']);
        Categoria::create($request->all());
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria criada!');
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate(['nome' => 'required|string|max:100']);
        $categoria->update($request->all());
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria atualizada!');
    }

    public function public()
    {
        $categorias = Categoria::all();
        return view('categorias.public', compact('categorias'));
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria excluída!');
    }
}
