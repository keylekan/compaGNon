@props([
    'selectedGodId',
    'isAllowed',
    'openItem',
])

{{-- Modal Détails --}}
<x-modal show="{{$openItem}}" :title="'Détails'">
    <div class="space-y-4">
        <template x-if="{{$openItem}}">
            <div>
                <div class="flex items-start gap-3">
                    <img
                        class="h-14 w-14 rounded-md border border-black/10 object-cover"
                        :src="{{$openItem}}.icon_path ? '/' + {{$openItem}}.icon_path : '{{ asset('images/logo.svg') }}'"
                        :alt="{{$openItem}}.name"
                    >

                    <div class="min-w-0">
                        <div class="text-lg font-semibold" x-text="{{$openItem}}.name ?? ''"></div>
                        <p class="mt-1 text-sm opacity-80" x-text="{{$openItem}}.short_description ?? ''"></p>
                    </div>
                </div>

                <x-markdown class="mt-2 text-sm text-sand-800"  value="{{$openItem}}.description || '—'" />

                <div class="mt-5 flex items-center justify-end gap-3">
                    <x-button @click="{{$openItem}} = false" variant="panel">
                        Fermer
                    </x-button>

                    <x-button
                        x-show="{{$selectedGodId}} != String({{$openItem}}.id)"
                        @click="{{$selectedGodId}} = String({{$openItem}}.id); {{$openItem}} = false"
                        disabled="!{{$isAllowed}}({{$openItem}})"
                    >
                        Choisir
                    </x-button>
                </div>
            </div>
        </template>
    </div>
</x-modal>
