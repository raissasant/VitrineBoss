@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-purple-100 px-4 py-10">
    <div class="max-w-screen-xl mx-auto bg-white/90 backdrop-blur p-6 md:p-10 rounded-2xl shadow-xl">

        <!-- Carrossel -->
        <div x-data="{ currentSlide: 0, total: 1 }"
             x-init="setInterval(() => currentSlide = (currentSlide + 1) % total, 6000)"
             class="relative overflow-hidden rounded-xl shadow-lg mb-10 h-64">
            <div class="flex transition-all duration-700 h-full"
                 :style="'transform: translateX(-' + currentSlide * 100 + '%)'">
                <img src="{{ asset('images/banner1.png') }}"
                     class="min-w-full object-cover h-full"
                     alt="Banner Vitrine Boss">
            </div>

            <!-- Setas -->
            <button @click="currentSlide = (currentSlide - 1 + total) % total"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow">◀</button>
            <button @click="currentSlide = (currentSlide + 1) % total"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow">▶</button>

            <!-- Pontinhos -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                <button class="w-3 h-3 rounded-full" :class="currentSlide === 0 ? 'bg-pink-500' : 'bg-gray-400'"></button>
            </div>
        </div>

        <!-- Produtos -->
        @if($produtos->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($produtos as $produto)
                    <div class="bg-gradient-to-br from-purple-600 to-pink-500 text-white rounded-xl shadow-lg overflow-hidden flex flex-col justify-between hover:scale-[1.02] transition">
                        @if($produto->imagem_path)
                            <img src="{{ asset('storage/' . $produto->imagem_path) }}"
                                 alt="{{ $produto->nome }}"
                                 class="w-full h-48 object-cover">
                        @endif

                        <div class="p-5 flex flex-col flex-1">
                            <h5 class="text-base font-semibold mb-1">{{ $produto->nome }}</h5>
                            <p class="text-xs text-pink-100 mb-3">{{ Str::limit($produto->descricao, 90) }}</p>

                            @if($produto->preco)
                                <p class="text-sm font-medium mb-4">
                                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                </p>
                            @endif

                            <!-- Botões estilizados -->
                            <div class="mt-auto flex flex-col gap-2 items-center">
                                <a href="{{ route('produto.go', $produto->slug) }}" target="_blank"
                                   class="bg-green-500 hover:bg-green-600 text-white text-xs font-semibold px-4 py-2 rounded shadow transition text-center w-full max-w-[160px]">
                                     Comprar Agora
                                </a>

                                <a href="{{ route('produto.show', $produto->slug) }}"
                                   class="bg-gradient-to-r from-purple-700 to-pink-500 hover:from-purple-800 hover:to-pink-600 text-white text-xs font-semibold px-4 py-2 rounded shadow transition text-center w-full max-w-[160px]">
                                     Ver Detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="mt-10">
                {{ $produtos->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center text-gray-600 mt-12">
                Nenhum produto encontrado.
            </div>
        @endif

    </div>
</div>
@endsection
