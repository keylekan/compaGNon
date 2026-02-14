@props([
  'size' => '6xl',
])

<?php
    $sizes = [
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        '6xl' => 'max-w-6xl',
    ];
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <title>{{ $title ?? config('app.name', 'Les Derniers de Solace') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-sand-50 text-sand-900 flex flex-col">
@livewireScripts
<header class="border-b border-sand-200 bg-white">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div class="relative flex h-16 items-center justify-between gap-3">
            {{-- Brand --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Les Derniers de Solace"
                        class="h-12 w-12 rounded-xl"
                    >
                    <div class="leading-tight">
                        <div class="text-sm font-semibold">Les Derniers de Solace</div>
                        <div class="text-xs text-sand-700">Association de Grandeur Nature</div>
                    </div>
                </a>
            </div>

            {{-- Nav (desktop) --}}
            <nav class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}"
                    @class([
                        'rounded-lg px-3 py-2 text-sm font-medium transition',
                        request()->routeIs('home')
                             ? 'bg-sand-200 text-sand-900'
                             : 'text-sand-800 hover:bg-sand-100'
                    ])>
                    Accueil
                </a>

                <a href="{{ route('characters.index') }}"
                    @class([
                        'rounded-lg px-3 py-2 text-sm font-medium transition',
                        request()->routeIs('characters.*')
                             ? 'bg-sand-200 text-sand-900'
                             : 'text-sand-800 hover:bg-sand-100'
                    ])>
                    Personnages
                </a>

                <a href="{{ route('events.index') }}"
                    @class([
                        'rounded-lg px-3 py-2 text-sm font-medium transition',
                        request()->routeIs('events.*')
                             ? 'bg-sand-200 text-sand-900'
                             : 'text-sand-800 hover:bg-sand-100'
                    ])>
                    Événements
                </a>

                @if(Auth::user()->admin)
                <a href="{{ route('admin.index') }}"
                    @class([
                        'rounded-lg px-3 py-2 text-sm font-medium transition',
                        request()->routeIs('admin.*')
                             ? 'bg-sand-200 text-sand-900'
                             : 'text-sand-800 hover:bg-sand-100'
                    ])>
                    Admin
                </a>
                @endif
            </nav>

            {{-- User dropdown + mobile menu --}}
            <div class="flex items-center gap-2" x-data="{ openUser: false, openMobile: false }">
                {{-- Mobile hamburger --}}
                <button
                    type="button"
                    class="md:hidden rounded-lg p-2 hover:bg-sand-100"
                    @click="openMobile = !openMobile"
                    aria-label="Ouvrir le menu"
                >
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 5h14v2H3V5zm0 4h14v2H3V9zm0 4h14v2H3v-2z" clip-rule="evenodd"/>
                    </svg>
                </button>

                {{-- User dropdown button --}}
                <button
                    type="button"
                    class="flex items-center gap-2 rounded-lg px-2 py-1.5 hover:bg-sand-100"
                    @click="openUser = !openUser"
                    @keydown.escape.window="openUser = false"
                    aria-label="Menu utilisateur"
                >
                    <div class="hidden sm:block text-right">
                        <div class="text-sm font-medium leading-4">{{ Auth::user()->name ?? 'Compte' }}</div>
                        <div class="text-xs text-sand-700 leading-4">{{ Auth::user()->email ?? '' }}</div>
                    </div>

                    <img
                        src="{{ Auth::user()->avatar_path }}"
                        alt="Avatar"
                        class="h-9 w-9 rounded-xl object-cover border border-sand-200"
                    >

                    <svg class="hidden sm:block h-4 w-4 text-sand-700" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Dropdown panel --}}
                <div
                    x-cloak
                    x-show="openUser"
                    @click.outside="openUser = false"
                    class="absolute right-0 top-16 z-50 w-56 rounded-xl border border-sand-200 bg-white p-1 shadow-lg"
                >
                    <a href="{{ route('account.settings') }}"
                       class="block rounded-lg px-3 py-2 text-sm text-sand-800 hover:bg-sand-100">
                        Paramètres du compte
                    </a>

                    <div class="my-1 h-px bg-sand-200"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full rounded-lg px-3 py-2 text-left text-sm text-sand-800 hover:bg-sand-100">
                            Se déconnecter
                        </button>
                    </form>
                </div>

                {{-- Mobile menu panel --}}
                <div
                    x-cloak
                    x-show="openMobile"
                    @click.outside="openMobile = false"
                    class="absolute left-4 right-4 top-16 z-40 rounded-xl border border-sand-200 bg-white p-2 shadow-lg md:hidden"
                >
                    <a href="{{ route('home') }}"
                       class="block rounded-lg px-3 py-2 text-sm font-medium hover:bg-sand-100">
                        Accueil
                    </a>
                    <a href="{{ route('characters.index') }}"
                       class="block rounded-lg px-3 py-2 text-sm font-medium hover:bg-sand-100">
                        Personnages
                    </a>
                    <a href="{{ route('events.index') }}"
                       class="block rounded-lg px-3 py-2 text-sm font-medium hover:bg-sand-100">
                        Événements
                    </a>
                    @if(Auth::user()->admin)
                    <a href="{{ route('admin.index') }}"
                       class="block rounded-lg px-3 py-2 text-sm font-medium hover:bg-sand-100">
                        Admin
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Optional page header --}}
@isset($header)
    <div class="border-b border-sand-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 py-6 sm:px-6">
            {{ $header }}
        </div>
    </div>
@endisset

<main class="w-full flex-1 mx-auto {{$sizes[$size] ?? 'max-w-6xl'}} px-4 py-8 sm:px-6">
    {{ $slot }}
</main>

@php
    $needsProfile = auth()->check() && (blank(auth()->user()->name) || blank(auth()->user()->birthdate));
@endphp

@if($needsProfile)
    <div
        x-data="{ open: true }"
        x-init="open = true"
        @keydown.escape.window.prevent.stop
    >
        <x-modal title="Complétez votre profil" can-close="false">
            <div class="space-y-4">
                <p class="text-sm text-sand-700">
                    Avant de continuer, renseignez votre nom et votre date de naissance. Vous pouvez aussi ajouter une image de profil.
                </p>

                <form
                    method="POST"
                    action="{{ route('account.settings.update') }}"
                    enctype="multipart/form-data"
                    class="space-y-4"
                >
                    @csrf
                    @method('PUT')

                    {{-- Nom --}}
                    <div>
                        <label for="onboarding_name" class="block text-sm font-medium text-sand-800">
                            Prénom & Nom
                        </label>
                        <input
                            id="onboarding_name"
                            name="name"
                            value="{{ old('name', auth()->user()->name) }}"
                            required
                            autofocus
                            class="mt-1 block w-full rounded-lg border border-sand-200
                                   bg-sand-50 px-3 py-2 text-sand-900
                                   focus:border-bronze-500 focus:outline-none
                                   focus:ring-4 focus:ring-teal-200"
                        >
                        @error('name')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date de naissance --}}
                    <x-input
                        id="birthdate"
                        name="birthdate"
                        label="Date de naissance"
                        type="date"
                        max="{{ now()->subYears(10)->format('Y-m-d') }}"
                        :value="old('birthdate', optional(auth()->user()->birthdate)->format('Y-m-d'))"
                        required
                        full
                    />

                    {{-- Avatar (optionnel) --}}
                    <div>
                        <label class="block text-sm font-medium text-sand-800 mb-2">
                            Photo de profil (optionnel pour vous mais utile pour nous)
                        </label>

                        <div class="flex items-center gap-4">
                            <img
                                src="{{ auth()->user()->avatar_path }}"
                                alt="Avatar"
                                class="h-14 w-14 rounded-xl object-cover border border-sand-200"
                            >

                            <input
                                type="file"
                                name="avatar"
                                accept="image/*"
                                class="text-sm text-sand-700 file:mr-4 file:rounded-lg file:border-0
                                       file:bg-sand-100 file:px-3 file:py-2
                                       file:text-sand-900 hover:file:bg-sand-200"
                            >
                        </div>

                        @error('avatar')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        {{-- pas de “Annuler” ici, pour forcer le nom --}}
                        <x-button type="submit" variant="primary">
                            Enregistrer
                        </x-button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
@endif

<footer class="border-t border-sand-200 bg-white">
    <div class="mx-auto max-w-6xl px-4 py-6 text-sm text-sand-700 sm:px-6">
        © {{ date('Y') }} Les Derniers de Solace
    </div>
</footer>
</body>
</html>
