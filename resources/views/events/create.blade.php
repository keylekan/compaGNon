<x-app-layout>
    <h1 class="text-xl font-semibold mb-6">Créer un événement</h1>

    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <p class="font-medium mb-2">Le formulaire contient des erreurs :</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('events.store') }}">
        @csrf

        <x-panel class="space-y-4">
            <x-input label="Titre" name="title" full required />

            <div class="flex gap-3">
                <x-input type="datetime-local" label="Début" name="starts_at" required />
                <x-input type="datetime-local" label="Fin" name="ends_at" />
            </div>

            <x-select label="Type" name="type">
                @foreach ($types as $type)
                    <option value="{{ $type->value }}">{{ $type->label() }}</option>
                @endforeach
            </x-select>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_published" value="1">
                <span>Publier immédiatement</span>
            </label>

            <x-button type="submit">Créer l’événement</x-button>
        </x-panel>
    </form>
</x-app-layout>
