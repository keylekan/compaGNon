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
    <aside class="bg-bronze-900 text-bronze-50 flex items-center justify-center p-10">
        <div class="max-w-sm w-full">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                {{-- Remplace par ton logo --}}
                <div class="h-12 w-12 rounded bg-white/10 grid place-items-center font-bold">
                    L
                </div>
                <span class="text-xl font-semibold">
                        {{ config('app.name', 'Mon App') }}
                    </span>
            </a>

            <p class="mt-6 text-white/80">
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
