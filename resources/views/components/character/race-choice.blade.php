@props([
    'races',
    'selectedRaceId',
    'openItem',
])

<div class="mt-5 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
    @foreach($races as $race)
        <x-choice-card
            name="race_id"
            :value="$race->id"
            :title="$race->title"
            :image="$race->image_path ? asset($race->image_path) : null"
            model="selectedRaceId"
        >
            <x-button
                variant="secondary"
                size="sm"
                @click.stop="{{$openItem}} = {{ Js::from($race) }}"
            >
                Détails
            </x-button>
        </x-choice-card>
    @endforeach
</div>
