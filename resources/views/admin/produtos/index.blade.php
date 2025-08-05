@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-pink-200 py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-xl">

        {{-- Título --}}
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Lista de Produtos</h2>

        {{-- Botão de novo produto --}}
        <div class="mb-8 text-center">
            <a href="{{ route('admin.produtos.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md text-sm font-semibold transition-all duration-300 transform hover:scale-105">
                + Novo Produto
            </a>
        </div>

        {{-- Lista de produtos --}}
        @if($produtos->count())
            <div class="space-y-5">
                @foreach ($produtos as $produto)
                    <div class="bg-white rounded-lg shadow-md p-6 transition-transform duration-300 hover:scale-[1.01]">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                            {{-- Imagem --}}
                            <div class="flex-shrink-0">
                                @if($produto->imagem_path)
                                    <img src="{{ asset('storage/' . $produto->imagem_path) }}"
                                         alt="{{ $produto->nome }}"
                                         class="h-24 w-24 object-cover rounded shadow">
                                @else
                                    <div class="h-24 w-24 flex items-center justify-center bg-gray-100 text-gray-400 rounded">
                                        Sem imagem
                                    </div>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $produto->nome }}</h3>
                                <p class="text-sm text-gray-500 mt-1 truncate">
                                    {{ $produto->categoria->nome ?? 'Sem categoria' }} |
                                    {{ $produto->plataforma->nome ?? 'Sem plataforma' }}
                                </p>
                            </div>

                            {{-- Ações --}}
                            <div class="flex flex-wrap gap-2 mt-4 md:mt-0 justify-center md:justify-end">
                                <a href="{{ route('produto.go', $produto->slug) }}"
                                   target="_blank"
                                   class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded shadow transition">
                                    Ver Produto
                                </a>

                                <a href="{{ route('admin.produtos.edit', $produto) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded shadow transition">
                                    Editar
                                </a>

                                <form action="{{ route('admin.produtos.destroy', $produto) }}" method="POST"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded shadow transition">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginação --}}
            <div class="mt-10">
                {{ $produtos->links() }}
            </div>
        @else
            <div class="text-center text-gray-600 text-lg mt-10">
                Nenhum produto encontrado.
            </div>
        @endif

    </div>
</div>
@endsection
