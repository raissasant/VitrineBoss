@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-pink-200 py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-xl">

        {{-- Título centralizado --}}
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-4">Categorias</h2>

        {{-- Botão abaixo do título --}}
        <div class="flex justify-center mb-8">
            <a href="{{ route('admin.categorias.create') }}"
               class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white px-6 py-2 rounded-lg shadow-md transition-all duration-300">
                + Nova Categoria
            </a>
        </div>

        {{-- Lista de categorias --}}
        @if ($categorias->count())
            <div class="space-y-4">
                @foreach ($categorias as $categoria)
                    <div class="flex justify-between items-center bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition">
                        <span class="text-gray-800 font-medium">{{ $categoria->nome }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categorias.edit', $categoria) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-4 py-1 rounded shadow transition">
                                Editar
                            </a>

                            <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded shadow transition"
                                        onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginação --}}
            <div class="mt-6">
                {{ $categorias->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-600 text-center mt-6">Nenhuma categoria encontrada.</p>
        @endif

    </div>
</div>
@endsection
