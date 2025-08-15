@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-pink-200 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-xl">

        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Editar Produto</h2>

        {{-- Mensagens --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Imagens atuais --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Imagens atuais</label>
            <div class="flex gap-3 flex-wrap">
                @foreach($produto->imagens as $imagem)
                    <div class="relative inline-block">
                        <img src="{{ asset('storage/' . $imagem->caminho) }}" class="h-24 w-24 rounded object-cover shadow">

                        {{-- Formulário de exclusão de imagem --}}
                        <form method="POST" action="{{ route('admin.produtos.imagens.destroy', [$produto->id, $imagem->id]) }}"
                              onsubmit="return confirm('Deseja remover esta imagem?')" class="absolute top-0 right-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-600 rounded-full px-2 py-1 text-xs">X</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Formulário de edição --}}
        <form method="POST" action="{{ route('admin.produtos.update', $produto->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input type="text" name="nome" value="{{ old('nome', $produto->nome) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Descrição --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="descricao" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">{{ old('descricao', $produto->descricao) }}</textarea>
            </div>

            {{-- Preço (string, opcional) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Preço <span class="text-gray-400">(opcional)</span></label>
                <input type="text" name="preco" value="{{ old('preco', $produto->preco) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"
                       placeholder="Ex.: 49,90 • R$ 197 • A combinar">
                <small class="text-gray-500">Aceita números e letras (ex.: “R$ 197”, “A combinar”).</small>
            </div>

            {{-- Link de Afiliado --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link de Afiliado</label>
                <input type="text" name="link_afiliado" value="{{ old('link_afiliado', $produto->link_afiliado) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Categoria --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                <select name="categoria_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(old('categoria_id', $produto->categoria_id) == $categoria->id)>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Plataforma --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Plataforma</label>
                <select name="plataforma_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                    @foreach ($plataformas as $plataforma)
                        <option value="{{ $plataforma->id }}" @selected(old('plataforma_id', $produto->plataforma_id) == $plataforma->id)>
                            {{ $plataforma->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Upload de novas imagens --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Adicionar novas imagens</label>
                <input type="file" name="imagens[]" multiple accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                <small class="text-gray-500">Você pode enviar várias imagens.</small>
            </div>

            {{-- Botões --}}
            <div class="pt-6 flex flex-col md:flex-row gap-4">
                <button type="submit"
                        class="w-full md:w-auto bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md">
                    Salvar Alterações
                </button>

                <a href="{{ route('admin.produtos.index') }}"
                   class="w-full md:w-auto text-center bg-white/50 hover:bg-white/70 text-gray-800 font-semibold py-2 px-6 rounded-lg shadow-md">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
