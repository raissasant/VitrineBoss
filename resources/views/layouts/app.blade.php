<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vitrine Boss') }}</title>

    <!-- Favicon atualizado -->
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Facebook Pixel --}}
    <script>
        !function(f,b,e,v,n,t,s){
            if(f.fbq)return; n=f.fbq=function(){ n.callMethod ?
            n.callMethod.apply(n,arguments) : n.queue.push(arguments) };
            if(!f._fbq)f._fbq=n; n.push=n; n.loaded=!0; n.version='2.0';
            n.queue=[]; t=b.createElement(e); t.async=!0;
            t.src=v; s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)
        }(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '2624312697724069'); // Seu Pixel ID
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id=2624312697724069&ev=PageView&noscript=1"/>
    </noscript>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-pink-50 via-purple-50 to-pink-100 text-gray-800">

    <!-- Container principal -->
    <div class="min-h-screen flex flex-col">

        {{-- TOPO: navegação --}}
        @include('layouts.navigation')

        {{-- CONTEÚDO PRINCIPAL --}}
        <main class="flex-1">
            @yield('content')
        </main>
    </div>

    {{-- SCRIPTS DE PÁGINA --}}
    @yield('scripts')

    {{-- BOTÕES FLUTUANTES: WhatsApp e Instagram --}}
    <div class="fixed bottom-20 right-4 z-50 flex flex-col gap-3">

        <!-- WhatsApp -->
        <a href="https://wa.me/5554996789791" target="_blank"
           class="bg-green-500 hover:bg-green-600 p-3 rounded-full shadow-lg transition-all transform hover:scale-110"
           title="Fale no WhatsApp">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.52 3.48A11.76 11.76 0 0012 0a11.76 11.76 0 00-8.52 3.48A11.76 11.76 0 000 12c0 2.11.55 4.13 1.6 5.92L0 24l6.2-1.6A11.87 11.87 0 0012 24c6.62 0 12-5.38 12-12a11.76 11.76 0 00-3.48-8.52zM12 22c-1.85 0-3.64-.49-5.23-1.4l-.37-.2-3.68.96.98-3.58-.22-.37A9.95 9.95 0 012 12C2 6.49 6.49 2 12 2c2.66 0 5.19 1.04 7.07 2.93A9.95 9.95 0 0122 12c0 5.51-4.49 10-10 10zm5.05-7.78l-2.22-.63a.99.99 0 00-.96.25l-.42.43c-1.06-.54-2.08-1.38-2.88-2.48-.37-.48-.33-1.1.1-1.52l.37-.38a.99.99 0 00.25-.96l-.63-2.22a1 1 0 00-1.15-.71c-1.05.21-1.84.92-2.12 1.91-.46 1.65.15 3.3 1.71 5.11 1.56 1.81 3.11 2.66 4.74 2.66.33 0 .66-.03.99-.1 1-.28 1.71-1.07 1.92-2.13a1 1 0 00-.71-1.15z"/>
            </svg>
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com/clickvitrine.boss" target="_blank"
           class="bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 p-3 rounded-full shadow-lg transition-all transform hover:scale-110"
           title="Instagram">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 1.5a3.5 3.5 0 100 7 3.5 3.5 0 000-7zm4.25-.88a.88.88 0 110 1.76.88.88 0 010-1.76z"/>
            </svg>
        </a>
    </div>
</body>
</html>
