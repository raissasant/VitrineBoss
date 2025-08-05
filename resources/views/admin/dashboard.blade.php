@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-purple-100 py-10 px-4">
    <div class="max-w-7xl mx-auto">

        <h1 class="text-3xl font-bold text-center text-purple-700 mb-10">Painel Administrativo</h1>

        {{-- Cards com links --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <a href="{{ route('admin.produtos.index') }}" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white p-6 rounded-xl shadow-lg text-center hover:scale-105 transition">
                <div class="text-sm opacity-90">Produtos</div>
                <div class="text-3xl font-bold">{{ $totalProdutos }}</div>
            </a>
            <a href="{{ route('admin.categorias.index') }}" class="bg-gradient-to-r from-green-500 to-green-400 text-white p-6 rounded-xl shadow-lg text-center hover:scale-105 transition">
                <div class="text-sm opacity-90">Categorias</div>
                <div class="text-3xl font-bold">{{ $totalCategorias }}</div>
            </a>
            <a href="{{ route('admin.plataformas.index') }}" class="bg-gradient-to-r from-indigo-600 to-purple-500 text-white p-6 rounded-xl shadow-lg text-center hover:scale-105 transition">
                <div class="text-sm opacity-90">Plataformas</div>
                <div class="text-3xl font-bold">{{ $totalPlataformas }}</div>
            </a>

            <a href="{{ route('admin.leads.index') }}" class="bg-gradient-to-r from-blue-500 to-indigo-400 text-white p-6 rounded-xl shadow-lg text-center hover:scale-105 transition">
                <div class="text-sm opacity-90">Leads</div>
                <div class="text-3xl font-bold">{{ \App\Models\Lead::count() }}</div>
            </a>
            <div class="bg-gradient-to-r from-pink-500 to-red-400 text-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-sm opacity-90">Cliques</div>
                <div class="text-3xl font-bold">{{ $totalCliques }}</div>
            </div>
        </div>

        {{-- Ações rápidas --}}
        <div class="flex flex-wrap justify-center gap-4 mb-10">
            <a href="{{ route('admin.produtos.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow text-sm">
                + Novo Produto
            </a>
            <a href="{{ route('admin.categorias.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow text-sm">
                + Nova Categoria
            </a>
            <a href="{{ route('admin.plataformas.create') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded shadow text-sm">
                + Nova Plataforma
            </a>
        </div>

        {{-- Filtro por período --}}
        <div class="bg-white p-6 rounded-xl shadow mb-8">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700">Data Inicial</label>
                    <input type="date" name="inicio" value="{{ request('inicio') }}"
                           class="border rounded px-3 py-2 focus:ring-pink-400 w-full">
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700">Data Final</label>
                    <input type="date" name="fim" value="{{ request('fim') }}"
                           class="border rounded px-3 py-2 focus:ring-pink-400 w-full">
                </div>
                <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded shadow mt-1 transition">
                    Filtrar
                </button>
            </form>
        </div>

        {{-- Gráficos --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Gráfico de Barras: Top 5 Produtos --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold text-purple-700 mb-4">Top 5 Produtos com Mais Cliques</h2>
                <canvas id="cliquesChart" height="100"></canvas>
            </div>

            {{-- Gráfico de Linhas: Cliques ao Longo do Tempo --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold text-purple-700 mb-4">Cliques Recentes</h2>
                <canvas id="cliquesPorDiaChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const barCtx = document.getElementById('cliquesChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Cliques',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(236, 72, 153, 0.7)', // pink
                borderColor: 'rgba(236, 72, 153, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ctx.parsed.y + ' cliques'
                    }
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const lineCtx = document.getElementById('cliquesPorDiaChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($diasLabels ?? []) !!},
            datasets: [{
                label: 'Cliques por dia',
                data: {!! json_encode($diasData ?? []) !!},
                fill: true,
                borderColor: 'rgba(139, 92, 246, 1)', // purple
                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
