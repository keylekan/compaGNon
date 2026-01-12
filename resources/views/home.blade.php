<x-app-layout>
    <x-slot:header>
        <h1 class="text-2xl font-semibold">Tableau de bord</h1>
        <p class="mt-1 text-sand-700">Votre personnage et vos prochains événements.</p>
    </x-slot:header>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Mon personnage --}}
        <section class="rounded-2xl border border-sand-300 bg-white p-6 lg:col-span-1">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold">Mon personnage</h2>
                    <p class="mt-1 text-sm text-sand-700">Accès rapide à votre fiche.</p>
                </div>
                <a href="{{ route('characters.index') }}"
                   class="rounded-lg bg-sand-100 px-3 py-2 text-sm font-medium hover:bg-sand-200">
                    Gérer
                </a>
            </div>

            {{-- Exemple état : aucun personnage --}}
            <div class="mt-4 rounded-xl bg-sand-50 p-4 text-sm text-sand-800">
                Vous n’avez pas encore créé de personnage.
                <div class="mt-3">
                    <a href="{{ route('characters.create') }}"
                       class="inline-flex rounded-lg bg-bronze-500 px-4 py-2 font-semibold text-sand-50 hover:bg-bronze-600">
                        Créer un personnage
                    </a>
                </div>
            </div>
        </section>

        {{-- Événements à venir --}}
        <section class="rounded-2xl border border-sand-300 bg-white p-6 lg:col-span-2">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold">Événements à venir</h2>
                    <p class="mt-1 text-sm text-sand-700">Les prochaines dates où vous êtes inscrit.</p>
                </div>
                <a href="{{ route('events.index') }}"
                   class="rounded-lg bg-sand-100 px-3 py-2 text-sm font-medium hover:bg-sand-200">
                    Voir tout
                </a>
            </div>

            <ul class="mt-4 divide-y divide-sand-200">
                {{-- Exemple item --}}
                <li class="py-4 flex items-center justify-between gap-4">
                    <div>
                        <div class="font-medium">GN – La Brèche d’Ambre</div>
                        <div class="text-sm text-sand-700">Samedi 14 mars 2026 · Solace (à confirmer)</div>
                    </div>
                    <a href="#"
                       class="text-sm font-semibold text-teal-600 hover:text-teal-700 underline underline-offset-4">
                        Détails
                    </a>
                </li>

                <li class="py-4 flex items-center justify-between gap-4">
                    <div>
                        <div class="font-medium">Atelier costumes</div>
                        <div class="text-sm text-sand-700">Dimanche 5 avril 2026 · Local assoc.</div>
                    </div>
                    <a href="#" class="text-sm font-semibold text-teal-600 hover:text-teal-700 underline underline-offset-4">
                        Détails
                    </a>
                </li>
            </ul>
        </section>
    </div>
</x-app-layout>
