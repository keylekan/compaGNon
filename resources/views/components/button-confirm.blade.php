@props([
    'action',
    'title' => 'Supprimer ?',
    'message' => 'Cette action est définitive.',
    'confirmText' => 'Supprimer',
    'cancelText' => 'Annuler',
    'buttonText' => 'Supprimer',
    'buttonVariant' => 'danger',
    'buttonSize' => 'sm',
    'modalTitle' => 'Confirmation',
])

<div x-data="{ open: false }" class="inline">
    <x-button
        :variant="$buttonVariant"
        :size="$buttonSize"
        type="button"
        @click="open = true"
    >
        {{ $buttonText }}
    </x-button>

    <x-modal
        show="open"
        :canClose="true"
        :title="$modalTitle"
        @close.window="open = false"
    >
        <div class="space-y-4">
            <div>
                <h3 class="text-lg font-semibold text-sand-900">{{ $title }}</h3>
                <p class="mt-1 text-sm text-sand-700">{{ $message }}</p>
            </div>

            <form method="POST" action="{{ $action }}" class="flex items-center justify-end gap-2">
                @csrf
                @method('DELETE')

                <x-button
                    variant="ghost"
                    type="button"
                    @click="open = false"
                >
                    {{ $cancelText }}
                </x-button>

                <x-button variant="danger" type="submit">
                    {{ $confirmText }}
                </x-button>
            </form>
        </div>
    </x-modal>
</div>
