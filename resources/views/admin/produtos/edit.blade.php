@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-pink-200 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-xl transition-all duration-500 ease-in-out hover:scale-[1.01]">

        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Editar Produto</h2>

        <form method="POST" action="{{ route('admin.produtos.update', $produto->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input type="text" name="nome" value="{{ $produto->nome }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none transition">
            </div>

            {{-- Descrição --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="descricao" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none transition">{{ $produto->descricao }}</textarea>
            </div>

                {{-- Imagem --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Imagem atual</label>
                @if($produto->imagem_path)
                    <img src="{{ asset('storage/' . $produto->imagem_path) }}" class="h-32 mb-2 rounded shadow">
                @endif
                <input type="file" name="imagem" accept="image/png,image/jpeg"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none transition">
            </div>
            {{-- Preço --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
                <input type="text" name="preco" value="{{ $produto->preco }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none transition">
            </div>

            {{-- Link Afiliado --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link de Afiliado</label>
                <input type="text" name="link_afiliado" value="{{ $produto->link_afiliado }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none transition">
            </div>

            {{-- Categoria --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                <select name="categoria_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none transition">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @if($produto->categoria_id == $categoria->id) selected @endif>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Plataforma --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Plataforma</label>
                <select name="plataforma_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none transition">
                    @foreach ($plataformas as $plataforma)
                        <option value="{{ $plataforma->id }}" @if($produto->plataforma_id == $plataforma->id) selected @endif>
                            {{ $plataforma->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botões --}}
            <div class="pt-6 flex flex-col md:flex-row gap-4">
                <button type="submit"
                    class="w-full md:w-auto bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                    Salvar Alterações
                </button>

                <a href="{{ route('admin.produtos.index') }}"
                   class="w-full md:w-auto text-center bg-white/50 hover:bg-white/70 text-gray-800 font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
