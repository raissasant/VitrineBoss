<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Plataforma;
use App\Models\Clique;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutos = Produto::count();
        $totalCategorias = Categoria::count();
        $totalPlataformas = Plataforma::count();
        $totalCliques = Clique::count();

        // Top 5 produtos mais clicados
        $produtos = Produto::withCount('cliques')
            ->orderBy('cliques_count', 'desc')
            ->take(5)
            ->get();

        $labels = $produtos->pluck('nome')->toArray();
        $data = $produtos->pluck('cliques_count')->toArray();

        // Últimos 7 dias de cliques
        $dias = collect(range(6, 0))->map(function ($i) {
            return Carbon::now()->subDays($i)->format('Y-m-d');
        });

        $diasLabels = $dias->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();

        $diasData = $dias->map(function ($data) {
            return Clique::whereDate('created_at', $data)->count();
        })->toArray();

        return view('admin.dashboard', compact(
            'totalProdutos',
            'totalCategorias',
            'totalPlataformas',
            'totalCliques',
            'labels',
            'data',
            'diasLabels',
            'diasData'
        ));
    }
}
