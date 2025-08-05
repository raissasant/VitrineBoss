<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plataforma;

class PlataformaController extends Controller
{
    public function index()
    {
        $plataformas = Plataforma::paginate(10);
        return view('admin.plataformas.index', compact('plataformas'));
    }

    public function create()
    {
        return view('admin.plataformas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'logo_url' => 'nullable|url'
        ]);

        Plataforma::create($request->all());
        return redirect()->route('admin.plataformas.index')->with('success', 'Plataforma criada!');
    }

    public function edit(Plataforma $plataforma)
    {
        return view('admin.plataformas.edit', compact('plataforma'));
    }

    public function update(Request $request, Plataforma $plataforma)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'logo_url' => 'nullable|url'
        ]);

        $plataforma->update($request->all());
        return redirect()->route('admin.plataformas.index')->with('success', 'Plataforma atualizada!');
    }
    public function public()
    {
        $plataformas = Plataforma::all();
        return view('plataformas.public', compact('plataformas'));
    }

    public function destroy(Plataforma $plataforma)
    {
        $plataforma->delete();
        return redirect()->route('admin.plataformas.index')->with('success', 'Plataforma excluída!');
    }
}
