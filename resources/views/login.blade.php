<x-guest-layout>
    <!-- Session Status -->
    <x-info-panel class="mb-4" :message="session('status')" />

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ms-3">
                {{ __('Se connecter') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
