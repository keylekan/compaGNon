<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-sand-100 text-sand-900">
<div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
    {{-- Panneau gauche --}}
    <aside class="bg-bronze-500 text-black flex items-center justify-center p-10">
        <div class="max-w-md w-full">
            <a href="{{ url('/') }}" class="flex flex-col items-center gap-3">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Les Derniers de Solace"
                    class="h-40 w-40"
                />
                <span class="text-3xl font-semibold">
                    CompaGNon
                </span>
                <span class="text-lg font-medium">
                    Les Derniers de Solace
                </span>
            </a>

            <p class="mt-3">
                Bienvenue ! Connecte-toi ou crée un compte pour continuer.
            </p>
        </div>
    </aside>

    {{-- Contenu à droite (centré) --}}
    <main class="flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
