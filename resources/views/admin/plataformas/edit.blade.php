@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-pink-200 py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-xl">

        {{-- Título --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Editar Plataforma</h2>

        <form method="POST" action="{{ route('admin.plataformas.update', $plataforma) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome da Plataforma</label>
                <input type="text" name="nome" value="{{ $plataforma->nome }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none"
                       required>
            </div>

            {{-- Logo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Logo URL (opcional)</label>
                <input type="text" name="logo_url" value="{{ $plataforma->logo_url }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none">
            </div>

            {{-- Botões --}}
            <div class="pt-4 flex flex-col md:flex-row gap-4">
                <button type="submit"
                        class="w-full md:w-auto bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                    Atualizar Plataforma
                </button>

                <a href="{{ route('admin.plataformas.index') }}"
                   class="w-full md:w-auto text-center bg-red-100 hover:bg-red-200 text-red-600 font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
