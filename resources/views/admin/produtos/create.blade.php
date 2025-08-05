@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-pink-200 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-xl">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Cadastrar Novo Produto</h2>

        <form method="POST" action="{{ route('admin.produtos.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input type="text" name="nome" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="descricao" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Imagem (PNG ou JPG)</label>
                <input type="file" name="imagem" accept="image/png,image/jpeg"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
                <input type="text" name="preco"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link de Afiliado</label>
                <input type="text" name="link_afiliado" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                <select name="categoria_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Plataforma</label>
                <select name="plataforma_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none">
                    @foreach ($plataformas as $plataforma)
                        <option value="{{ $plataforma->id }}">{{ $plataforma->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="pt-6 flex flex-col md:flex-row gap-4">
                <button type="submit"
                        class="w-full md:w-auto bg-gradient-to-r from-pink-400 to-purple-400 hover:from-pink-500 hover:to-purple-500 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                    Salvar Produto
                </button>

                <a href="{{ route('admin.produtos.index') }}"
                   class="w-full md:w-auto text-center bg-red-100 hover:bg-red-200 text-red-600 font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
