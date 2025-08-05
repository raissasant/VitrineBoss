<!-- Topo da Vitrine -->
<nav x-data="{ open: false }" class="bg-white shadow z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-6 flex flex-wrap justify-between items-center gap-4">
        <!-- Logo + Links principais -->
        <div class="flex items-center gap-6 flex-wrap">
            <a href="{{ route('home') }}" class="flex items-center gap-3 transition hover:opacity-90">
                <img src="{{ asset('images/logo.png') }}" alt="Vitrine Boss" class="h-16 w-auto"> {{-- Aumentado --}}
                <span class="text-2xl font-bold text-purple-700">Vitrine <span class="text-pink-500">Boss</span></span>
            </a>

            <!-- Navegação Desktop -->
            <div class="hidden md:flex gap-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-600 font-medium">Início</a>
                <a href="{{ route('categorias.public') }}" class="text-gray-700 hover:text-pink-600 font-medium">Categorias</a>
                <a href="{{ route('plataformas.public') }}" class="text-gray-700 hover:text-pink-600 font-medium">Plataformas</a>

                @auth
                    <a href="{{ route('admin.produtos.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Produtos</a>
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-purple-600 font-semibold">Dashboard</a>
                @endauth
            </div>
        </div>

        <!-- Ícone do menu mobile -->
        <div class="md:hidden">
            <button @click="open = !open"
                    class="text-gray-700 transition hover:scale-105 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Ações do usuário -->
        <div class="hidden md:flex items-center gap-4 text-sm">
            @auth
                <span class="text-gray-700 font-medium">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:underline font-medium">Sair</button>
                </form>
            @endauth
        </div>
    </div>

    <!-- Menu mobile -->
    <div x-show="open" x-transition.duration.300ms class="md:hidden px-4 pb-4 space-y-2">
        <a href="{{ route('home') }}" class="block text-gray-700 hover:text-pink-600 transition">Início</a>
        <a href="{{ route('categorias.public') }}" class="block text-gray-700 hover:text-pink-600 transition">Categorias</a>
        <a href="{{ route('plataformas.public') }}" class="block text-gray-700 hover:text-pink-600 transition">Plataformas</a>

        @auth
            <a href="{{ route('admin.produtos.index') }}" class="block text-gray-700 hover:text-purple-600 transition">Produtos</a>
            <a href="{{ route('admin.dashboard') }}" class="block text-gray-700 hover:text-purple-600 transition">Dashboard</a>
            <div class="text-sm text-gray-700">👤 {{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-500 hover:underline mt-1 transition">Sair</button>
            </form>
        @endauth
    </div>

    <!-- Barra gradiente -->
    <div class="h-1 w-full bg-gradient-to-r from-purple-700 via-indigo-500 to-pink-500"></div>

    <!-- Barra de busca -->
    <div class="bg-gray-100 py-4">
        <div class="max-w-5xl mx-auto px-4">
            <form method="GET" action="{{ route('home') }}"
                  class="flex flex-col lg:flex-row justify-center items-stretch lg:items-center gap-2 lg:gap-4">

                <select name="categoria_id"
                        class="px-3 py-2 rounded border w-full lg:w-52 focus:ring-2 focus:ring-pink-400">
                    <option value="">Todas Categorias</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>

                <select name="plataforma_id"
                        class="px-3 py-2 rounded border w-full lg:w-52 focus:ring-2 focus:ring-pink-400">
                    <option value="">Todas Plataformas</option>
                    @foreach ($plataformas as $plataforma)
                        <option value="{{ $plataforma->id }}" {{ request('plataforma_id') == $plataforma->id ? 'selected' : '' }}>
                            {{ $plataforma->nome }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="busca"
                       placeholder="Buscar produtos..."
                       value="{{ request('busca') }}"
                       class="flex-1 px-4 py-2 rounded border focus:ring-2 focus:ring-pink-400 w-full">

                <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded shadow transition transform hover:scale-105">
                    🔍
                </button>
            </form>
        </div>
    </div>
</nav>
