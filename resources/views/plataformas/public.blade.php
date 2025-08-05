@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-purple-100 py-10 px-4">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Escolha uma Plataforma</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @foreach ($plataformas as $plataforma)
                <a href="{{ route('home', ['plataforma_id' => $plataforma->id]) }}"
                   class="flex flex-col items-center justify-center bg-gradient-to-r from-purple-700 to-pink-500 text-white p-5 rounded-xl shadow hover:shadow-xl hover:opacity-95 transition text-center">
                    @if($plataforma->logo_url)
                        <div class="bg-white rounded-full w-14 h-14 flex items-center justify-center mb-3 overflow-hidden shadow">
                            <img src="{{ $plataforma->logo_url }}" alt="{{ $plataforma->nome }}"
                                 class="h-10 w-10 object-contain">
                        </div>
                    @endif
                    <span class="text-sm font-semibold">{{ $plataforma->nome }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
