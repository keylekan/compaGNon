<x-app-layout size="2xl">
    <x-slot:header>
        <h1 class="text-2xl font-semibold">Paramètres du compte</h1>
        <p class="mt-1 text-sand-700">Gérez vos informations personnelles.</p>
    </x-slot:header>

    <x-info-panel class="mb-6" :message="session('status')" />

    <form
        method="POST"
        action="{{ route('account.settings.update') }}"
        enctype="multipart/form-data"
        class="rounded-2xl border border-sand-300 bg-white p-6"
    >
        @csrf
        @method('PUT')

        <div class="space-y-6">
            {{-- Avatar --}}
            <div>
                <label class="block text-sm font-medium text-sand-800 mb-2">
                    Image de profil
                </label>

                <div class="flex items-center gap-4">
                    <img
                        src="{{ $user->avatar_path }}"
                        alt="Avatar"
                        class="h-16 w-16 rounded-xl object-cover border border-sand-300"
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

            {{-- Email (readonly) --}}
            <div>
                <label class="block text-sm font-medium text-sand-800">
                    Adresse email
                </label>
                <input
                    type="email"
                    value="{{ $user->email }}"
                    disabled
                    class="mt-1 block w-full rounded-lg border border-sand-300
                           bg-sand-100 px-3 py-2 text-sand-700"
                >
                <p class="mt-1 text-xs text-sand-600">
                    L’adresse email ne peut pas être modifiée.
                </p>
            </div>

            {{-- Nom --}}
            <div>
                <label for="name" class="block text-sm font-medium text-sand-800">
                    Nom
                </label>
                <input
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                    class="mt-1 block w-full rounded-lg border border-sand-300
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
                full
            />

            {{-- Actions --}}
            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    class="rounded-lg bg-bronze-500 px-4 py-2
                           font-semibold text-sand-50 hover:bg-bronze-600"
                >
                    Enregistrer
                </button>

                <a
                    href="{{ route('home') }}"
                    class="rounded-lg bg-sand-100 px-4 py-2
                           font-medium text-sand-900 hover:bg-sand-200"
                >
                    Annuler
                </a>
            </div>
        </div>
    </form>
</x-app-layout>
