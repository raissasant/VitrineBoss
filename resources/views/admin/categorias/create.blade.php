@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-pink-200 py-10 px-4">
    <div class="max-w-xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-xl">

        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Nova Categoria</h2>

        <form method="POST" action="{{ route('admin.categorias.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome da Categoria</label>
                <input type="text" name="nome"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-300 focus:outline-none"
                    required>
            </div>

            <div class="pt-4 flex flex-col md:flex-row gap-4">
                <button type="submit"
                    class="w-full md:w-auto bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                    Salvar
                </button>

                <a href="{{ route('admin.dashboard') }}"
                   class="w-full md:w-auto text-center bg-white/50 hover:bg-white/70 text-gray-800 font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
