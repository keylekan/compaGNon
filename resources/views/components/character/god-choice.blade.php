@props([
    'gods',
    'selectedGodId',
    'isAllowed',
    'openItem',
])

<div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($gods as $god)
        @php
            $allowedBelieverAlignments = Js::from($god->allowed_believer_alignments)
        @endphp

        <x-choice-line
            name="god_id"
            :value="$god->id"
            :title="$god->name"
            :description="$god->short_description"
            :image="$god->icon_path ? asset($god->icon_path) : null"
            model="selectedGodId"
            disabled="!{{$isAllowed}}({{ Js::from($god) }})"
        >
            <x-button
                variant="secondary"
                size="sm"
                @click.stop="{{$openItem}} = {{ Js::from($god) }}"
            >
                Détails
            </x-button>
        </x-choice-line>
    @endforeach
</div>
