@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-between bg-gradient-to-br from-purple-50 via-pink-50 to-purple-100">
    <main class="px-4 py-6 sm:py-10">
        <div class="max-w-screen-xl mx-auto bg-white/90 backdrop-blur px-4 sm:px-6 md:px-10 py-6 sm:py-8 rounded-2xl shadow-xl">

            {{-- Banner carrossel com vídeos --}}
            <div x-data="{ currentSlide: 0, total: 2 }"
                 x-init="setInterval(() => currentSlide = (currentSlide + 1) % total, 20000)"
                 class="relative overflow-hidden rounded-xl shadow-lg mb-8 sm:mb-10 h-48 sm:h-64 md:h-80 lg:h-[400px]">
                <div class="flex transition-all duration-700 h-full w-full"
                     :style="'transform: translateX(-' + currentSlide * 100 + '%)'">

                    <!-- Slide 1 -->
                    <video autoplay muted loop playsinline preload="none" class="min-w-full object-cover h-full">
                        <source src="{{ asset('storage/banner/apresentacao.mp4') }}" type="video/mp4">
                        Seu navegador não suporta vídeo.
                    </video>

                    <!-- Slide 2 -->
                    <video autoplay muted loop playsinline preload="none" class="min-w-full object-cover h-full">
                        <source src="{{ asset('storage/banner/divulga.mp4') }}" type="video/mp4">
                        Seu navegador não suporta vídeo.
                    </video>
                </div>
            </div>

            {{-- Lista de Produtos --}}
            @if($produtos->count())
                {{-- 👇 layout restaurado: 2 col no mobile, 3 no desktop --}}
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-5">
                    @foreach ($produtos as $produto)
                        @php
                            $imgs = $produto->imagens;
                            $imgsCount = $imgs->count();
                        @endphp

                        <div class="bg-white border border-gray-200 rounded-xl shadow hover:shadow-md transition overflow-hidden flex flex-col">

                            {{-- Carrossel de imagens do produto (com fallback) --}}
                            <div
                                x-data="{ slide: 0, total: {{ max(1, $imgsCount) }} }"
                                x-init="if(total>1){ setInterval(() => slide = (slide + 1) % total, 3000) }"
                                class="relative w-full h-40 sm:h-48 md:h-56 overflow-hidden bg-white"
                            >
                                <div class="flex transition-all duration-700 w-full h-full"
                                     :style="'transform: translateX(-' + slide * 100 + '%)'">
                                    @if($imgsCount > 0)
                                        @foreach($imgs as $imagem)
                                            <img
                                                src="{{ asset('storage/' . $imagem->caminho) }}"
                                                class="w-full h-full object-contain flex-shrink-0 bg-white"
                                                alt="{{ $produto->nome }}"
                                                loading="lazy"
                                            >
                                        @endforeach
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-400 flex-shrink-0">
                                            <span class="text-xs">Sem imagem</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Conteúdo do produto --}}
                            <div class="p-3 flex flex-col flex-1">
                                <h3 class="text-sm font-semibold text-gray-800 leading-snug mb-1">
                                    {{ $produto->nome }}
                                </h3>

                                <p class="text-[11px] text-gray-600 mb-2 leading-snug">
                                    {{ \Illuminate\Support\Str::limit($produto->descricao, 60) }}
                                </p>

                                {{-- Preço padronizado pelo accessor --}}
                                          
                                @if($produto->preco_formatado)
                                    <p class="text-sm text-green-600 font-bold mb-2">
                                        {{ $produto->preco_formatado }}
                                    </p>
                                @else
                                    <p class="text-xs text-gray-500 mb-2">
                                        Preço sob consulta
                                    </p>
                                @endif

                                {{-- Botões --}}
                                <div class="mt-auto flex flex-col gap-2 w-full">
                                    <a href="{{ route('produto.go', $produto->slug) }}" target="_blank" rel="noopener"
                                       class="w-full bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded text-center transition">
                                        Comprar
                                    </a>
                                    <a href="{{ route('produto.show', $produto->slug) }}"
                                       class="w-full bg-gradient-to-r from-purple-700 to-pink-500 hover:from-purple-800 hover:to-pink-600 text-white text-sm font-semibold px-4 py-2 rounded text-center transition">
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginação (view customizada para mobile/desktop iguais) --}}
                <div class="mt-8">
                    {{ $produtos->withQueryString()->links('components.pagination') }}
                </div>
            @else
                <div class="text-center text-gray-600 mt-12">
                    Nenhum produto encontrado.
                </div>
            @endif
        </div>
    </main>

    {{-- Rodapé --}}
    <footer class="bg-purple-500 text-white py-5 px-4">
        <div class="max-w-screen-xl mx-auto text-center text-sm">
            © {{ date('Y') }} Vitrine Boss. Todos os direitos reservados.
        </div>
    </footer>
</div>
@endsection
