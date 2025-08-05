<x-guest-layout>
    <div class="w-full max-w-5xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 min-h-screen">

        <!-- Lado esquerdo: Imagem -->
        <div class="hidden md:flex items-center justify-center bg-gradient-to-br from-purple-700 to-pink-500">
            <img src="{{ asset('images/login-illustration.png') }}" alt="Login" class="w-3/4 max-h-[400px] object-contain">
        </div>

        <!-- Lado direito: Formulário -->
        <div class="flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <h1 class="text-3xl font-extrabold text-center text-purple-700 mb-6">
                    Acesso <span class="text-pink-500">Vitrine Boss</span>
                </h1>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" type="email" name="email"
                                      :value="old('email')" required autofocus
                                      class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Senha -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Senha')" />
                        <x-text-input id="password" type="password" name="password"
                                      required autocomplete="current-password"
                                      class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Lembrar -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-600">Lembrar de mim</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm text-pink-600 hover:underline">
                                Esqueceu a senha?
                            </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full justify-center">
                        Entrar
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
