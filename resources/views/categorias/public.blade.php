@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-purple-100 py-10 px-4">
    <div class="max-w-6xl mx-auto text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Todas as Categorias</h1>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @foreach($categorias as $categoria)
                <a href="{{ route('home', ['categoria_id' => $categoria->id]) }}"
                   class="flex flex-col items-center justify-center bg-gradient-to-r from-purple-700 to-pink-500 text-white p-5 rounded-xl shadow hover:shadow-xl hover:opacity-95 transition text-center">
                    <div class="bg-white text-pink-600 rounded-full w-12 h-12 flex items-center justify-center mb-3 text-xl shadow">
                        📁
                    </div>
                    <span class="text-sm font-semibold">{{ $categoria->nome }}</span>
                </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $categorias->links() }}
        </div>
    </div>
</div>
@endsection
