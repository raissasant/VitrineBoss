@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-purple-100 px-4 py-10">
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur p-6 md:p-10 rounded-2xl shadow-xl">

        {{-- Título, Descrição e Preço --}}
        <div class="mb-6 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">{{ $produto->nome }}</h1>
            <p class="text-sm text-gray-600 mt-2">{{ $produto->descricao }}</p>

            @if($produto->preco_formatado)
                <p class="text-lg font-semibold text-pink-600 mt-3">
                    Preço: {{ $produto->preco_formatado }}
                </p>
            @else
                <p class="text-xs text-gray-500 mt-3">Preço sob consulta</p>
            @endif
        </div>

        {{-- Imagem --}}
        @if($produto->imagem_path)
            <div class="mb-8">
                <img src="{{ asset('storage/' . $produto->imagem_path) }}"
                     alt="{{ $produto->nome }}"
                     class="w-full max-h-[400px] object-contain rounded shadow mx-auto">
            </div>
        @endif

        {{-- Botão de compra direto --}}
        <div class="flex justify-center mb-10">
            <a href="{{ route('produto.go', $produto->slug) }}" target="_blank"
               class="bg-green-600 hover:bg-green-700 text-white text-lg px-6 py-3 rounded-md shadow-md transition">
                Comprar agora 
            </a>
        </div>

        {{-- Texto de incentivo ao formulário --}}
        <div class="text-center text-sm text-gray-600 mb-8 max-w-2xl mx-auto">
            <p class="mb-2">
                Ainda com dúvidas sobre o <strong>{{ $produto->nome }}</strong>?
            </p>
            <p>
                Preencha o formulário abaixo para receber mais informações, bônus ou atendimento personalizado.
            </p>
        </div>

        {{-- Formulário de Captura de Lead --}}
        <div class="bg-white shadow-lg rounded-xl p-8 max-w-xl mx-auto border border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                📬 Receba informações sobre <span class="text-pink-600">{{ $produto->nome }}</span>
            </h3>

            @if(session('sucesso'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4 text-sm text-center font-medium">
                    {{ session('sucesso') }}
                </div>
            @endif

            <form method="POST" action="{{ route('capturar.lead') }}" class="space-y-5">
                @csrf

                {{-- Envio do nome e slug do produto --}}
                <input type="hidden" name="produto_nome" value="{{ $produto->nome }}">
                <input type="hidden" name="produto_slug" value="{{ $produto->slug }}">

                {{-- Nome --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Seu Nome</label>
                    <input type="text" name="nome" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-400">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-400">
                </div>

                {{-- WhatsApp --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp"
                           placeholder="Ex: 54999999999"
                           inputmode="numeric" pattern="\d*" maxlength="14"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-400">
                </div>

                {{-- Botão --}}
                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white font-semibold py-3 rounded-md transition shadow-lg">
                        Quero saber mais
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sucesso = document.querySelector('.bg-green-100');

        if (sucesso && typeof fbq !== 'undefined') {
            fbq('track', 'Lead');
            console.log('✅ Evento Lead disparado para o Pixel Meta');
        }

        // Restringe o campo WhatsApp para aceitar apenas números
        const whatsappInput = document.getElementById('whatsapp');
        if (whatsappInput) {
            whatsappInput.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '');
            });
        }
    });
</script>
@endsection
