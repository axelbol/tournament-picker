<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=open-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Livewire Styles --}}
    @livewireStyles
</head>
<body class="font-open-sans bg-gray-900 text-white text-sm">
    {{-- Header --}}
    <header class="border-b border-green-600 flex mx-auto items-center justify-between px-32 py-6">
        <a href="/">
            <img src="{{ asset('img/creatorseries-primary-logo.svg') }}" alt="Logo" class="w-64 flex-none">
        </a>
        <div class="flex items-center">
            <ul class="flex space-x-8">
                <li><a href="#" class="hover:text-green-400 font-extrabold text-lg">MDC</a></li>
                <li><a href="#" class="hover:text-green-400 font-extrabold text-lg">Libertadores</a></li>
                <li><a href="#" class="hover:text-green-400 font-extrabold text-lg">Sudamericana</a></li>
            </ul>
        </div>
    </header>

    {{-- Main --}}
    <main class="py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-green-600 text-center py-6">
        <p class="text-gray-400">
            &copy; {{ date('Y') }} Creator Series. All rights reserved.
        </p>
        <p class="text-gray-500 text-xs mt-2">
            Built with <a href="https://laravel.com" class="text-green-400 hover:underline">Laravel</a> and <a href="https://tailwindcss.com" class="text-green-400 hover:underline">Tailwind CSS</a>.
        </p>
    </footer>
    {{-- Livewire Scripts --}}
    @livewireScripts

    {{-- Stack de scripts adicionales como html2canvas --}}
    @stack('scripts')
</body>
</html>
