<button {{ $attributes->merge(['type' => 'submit', 'class' => 'border border-transparent tracking-widest inline-flex items-center rounded-lg bg-bronze-500 px-4 py-2 font-semibold text-xs uppercase text-sand-50 hover:bg-bronze-400 focus:outline-none focus:ring-4 focus:ring-teal-200 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
