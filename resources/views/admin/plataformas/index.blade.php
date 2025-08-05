@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-pink-200 py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-xl">

        {{-- Título centralizado --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Plataformas</h2>

        {{-- Botão Nova Plataforma --}}
        <div class="text-center mb-6">
            <a href="{{ route('admin.plataformas.create') }}"
               class="inline-block bg-pink-600 hover:bg-pink-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition-all duration-300">
                + Nova Plataforma
            </a>
        </div>

        {{-- Lista de plataformas --}}
        @forelse ($plataformas as $plataforma)
            <div class="bg-white p-4 rounded-lg shadow mb-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <strong class="text-gray-800 text-lg">{{ $plataforma->nome }}</strong>
                    @if($plataforma->logo_url)
                        <img src="{{ $plataforma->logo_url }}" alt="logo" class="h-10 w-10 object-contain">
                    @endif
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.plataformas.edit', $plataforma) }}"
                       class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-4 py-1 rounded shadow">
                        Editar
                    </a>

                    <form action="{{ route('admin.plataformas.destroy', $plataforma) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-1 rounded shadow">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-600">Nenhuma plataforma cadastrada.</p>
        @endforelse

        {{-- Paginação --}}
        <div class="mt-6">
            {{ $plataformas->links() }}
        </div>
    </div>
</div>
@endsection
