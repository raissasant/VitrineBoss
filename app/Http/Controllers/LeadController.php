<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'whatsapp' => 'nullable|string|max:20',
            'produto_nome' => 'nullable|string|max:255',
            'produto_slug' => 'nullable|string|max:255',
        ]);

        // Salvar lead no banco
        Lead::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'produto' => $request->produto_nome,
        ]);

        // Redireciona com mensagem de sucesso
        return redirect()->back()->with('sucesso', 'Lead capturado com sucesso! Entraremos em contato em breve.');
    }
}
