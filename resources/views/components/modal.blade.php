@props([
  'show' => 'open', // expression Alpine
  'canClose' => true,
  'title' => null,
])

<div
    x-cloak
    x-show="{{ $show }}"
    x-transition.opacity
    class="fixed inset-0 z-50 overflow-y-auto bg-sand-500/40"
    aria-modal="true"
    role="dialog"
>
    <div
        class="flex min-h-screen items-center justify-center p-4"
        @click="{{ $canClose }} && ({{ $show }} = false)">
        <div
            x-transition
            class="w-full max-w-2xl rounded-2xl border border-sand-300 bg-sand-50 shadow-lg overflow-hidden"
            @click.stop
        >
            <div class="flex items-center justify-between px-6 py-3 border-b border-sand-300">
                <div class="font-semibold text-sand-900">{{ $title }}</div>
                <button
                    type="button"
                    class="rounded-lg px-2 text-sand-600 hover:bg-sand-100"
                    @click="{{ $show }} = false"
                    x-show="{{ $canClose }}">
                    ✕
                </button>
            </div>

            <div class="px-6 py-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
