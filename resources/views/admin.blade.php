<x-app-layout size="4xl">
    <x-info-panel class="mb-6" :message="session('success')" />

    <x-panel
        x-data="{ open: true }"
    >
        <button
            type="button"
            @click="open = !open"
            class="flex w-full items-center justify-between gap-4 text-left cursor-pointer"
        >
            <div>
                <h2 class="text-lg font-semibold text-sand-950">
                    Inviter des administrateurs
                </h2>
                <p class="mt-1 text-sm text-sand-700">
                    Ajoutez une liste d’emails. S’il existe déjà un compte, il sera passé en admin.
                </p>
            </div>
            {{-- Chevron --}}
            <svg
                class="ml-1 h-5 w-5 transform transition-transform duration-200
                       group-hover:text-bronze-900"
                :class="open ? 'rotate-0' : '-rotate-90'"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        {{-- Contenu repliable --}}
        <div
            x-show="open"
            x-collapse
            x-cloak
            class="mt-4"
        >
            {{-- À restreindre plus tard via @can('manage', $event) --}}
            <form
                method="POST"
                action="{{ route('admin.invite') }}"
                class="space-y-4"
            >
                @csrf

                <div>
                    <label class="block text-sm font-medium text-sand-900" for="emails">
                        Emails
                    </label>
                    <p class="mt-1 text-xs text-sand-600">
                        Un par ligne, ou séparés par virgule / point-virgule / espace.
                    </p>

                    <textarea
                        id="emails"
                        name="emails"
                        rows="6"
                        class="mt-2 w-full rounded-lg border border-sand-200 bg-white px-3 py-2 text-sm text-sand-900 shadow-sm
                           focus:border-bronze-400 focus:outline-none focus:ring-2 focus:ring-bronze-200"
                        placeholder="ex: arthur@exemple.com&#10;merlin@exemple.com"
                        required
                    >{{ old('emails') }}</textarea>

                    @error('emails')
                    <p class="mt-2 text-sm text-bronze-800">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="flex items-end">
                        <x-button type="submit" variant="panel">
                            Traiter les invitations
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </x-panel>

    <x-panel class="mt-6">
        <div class="divide-y divide-sand-400 rounded-lg border border-sand-400 overflow-hidden">
            @foreach($admins as $admin)
                @php
                    $userName = empty($admin->name) ? 'Compte non finalisé' : $admin->name;
                    $email = $admin->email;
                @endphp

                <div class="p-2">
                    <div class="text-sm font-semibold {{empty($admin->name) ? 'opacity-70' : ''}}">
                        {{ $userName }}
                    </div>
                    <div class="text-xs opacity-70">
                        {{ $email }}
                    </div>
                </div>
            @endforeach
        </div>
    </x-panel>
</x-app-layout>
