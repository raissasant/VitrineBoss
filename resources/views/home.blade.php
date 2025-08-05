@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-between bg-gradient-to-br from-purple-50 via-pink-50 to-purple-100">
    <main class="px-4 py-6 sm:py-10">
        <div class="max-w-screen-xl mx-auto bg-white/90 backdrop-blur px-4 sm:px-6 md:px-10 py-6 sm:py-8 rounded-2xl shadow-xl">

            <!-- Carrossel Responsivo -->
            <div x-data="{ currentSlide: 0, total: 2 }"
                 x-init="setInterval(() => currentSlide = (currentSlide + 1) % total, 6000)"
                 class="relative overflow-hidden rounded-xl shadow-lg mb-8 sm:mb-10 h-48 sm:h-64 md:h-80 lg:h-[400px]">

                <div class="flex transition-all duration-700 h-full w-full"
                     :style="'transform: translateX(-' + currentSlide * 100 + '%)'">

                    <!-- Slide 1 - Imagem -->
                    
                    
                         
                         <img src="{{ asset('images/bem vindo.png') }}"
                         class="min-w-full object-cover h-full"
                         alt="Banner Imagem">

                    <!-- Slide 2 - Vídeo -->
                    <video autoplay muted loop playsinline
                           class="min-w-full object-cover h-full">
                        <source src="{{ asset('storage/banner/promocao.mp4') }}" type="video/mp4">
                        Seu navegador não suporta vídeo.
                    </video>

            
                    <!-- Slide 3 - GIF (comentado) -->
                    {{--
                    <img src="{{ asset('images/banner2.gif') }}"
                         class="min-w-full object-cover h-full"
                         alt="Banner GIF">
                    --}}
                </div>

                <!-- Botões -->
                <button @click="currentSlide = (currentSlide - 1 + total) % total"
                        class="absolute left-2 sm:left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white p-1 sm:p-2 rounded-full shadow text-sm sm:text-base">◀</button>

                <button @click="currentSlide = (currentSlide + 1) % total"
                        class="absolute right-2 sm:right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white p-1 sm:p-2 rounded-full shadow text-sm sm:text-base">▶</button>

                <!-- Indicadores REMOVIDOS -->
            </div>

            <!-- Lista de Produtos -->
            @if($produtos->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($produtos as $produto)
                        <div class="bg-gradient-to-br from-purple-600 to-pink-500 text-white rounded-xl shadow-lg overflow-hidden flex flex-col justify-between hover:scale-[1.02] transition">
                            @if($produto->imagem_path)
                                <img src="{{ asset('storage/' . $produto->imagem_path) }}"
                                     alt="{{ $produto->nome }}"
                                     class="w-full h-40 sm:h-48 md:h-52 object-cover">
                            @endif

                            <div class="p-4 sm:p-5 flex flex-col flex-1">
                                <h5 class="text-base sm:text-lg font-semibold mb-1">{{ $produto->nome }}</h5>
                                <p class="text-xs sm:text-sm text-pink-100 mb-3">{{ Str::limit($produto->descricao, 90) }}</p>

                                @if($produto->preco)
                                    <p class="text-sm sm:text-base font-medium mb-4">
                                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                    </p>
                                @endif

                                <!-- Botões -->
                                <div class="mt-auto flex flex-col gap-2 items-center">
                                    <a href="{{ route('produto.go', $produto->slug) }}" target="_blank"
                                       class="bg-green-500 hover:bg-green-600 text-white text-xs sm:text-sm font-semibold px-4 py-2 rounded shadow transition text-center w-full max-w-[180px]">
                                         Comprar Agora
                                    </a>

                                    <a href="{{ route('produto.show', $produto->slug) }}"
                                       class="bg-gradient-to-r from-purple-700 to-pink-500 hover:from-purple-800 hover:to-pink-600 text-white text-xs sm:text-sm font-semibold px-4 py-2 rounded shadow transition text-center w-full max-w-[180px]">
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
    </main>

    <!-- Rodapé -->
    <footer class="bg-purple-500 text-white py-5 px-4">
        <div class="max-w-screen-xl mx-auto text-center text-sm">
            © {{ date('Y') }} Vitrine Boss. Todos os direitos reservados.
        </div>
    </footer>
</div>
@endsection
