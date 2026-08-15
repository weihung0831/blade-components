@props(['title', 'description' => null, 'code', 'vueCode' => null])

<section {{ $attributes }}>
    <h2 class="text-lg font-semibold tracking-tight text-cream">{{ $title }}</h2>
    @if ($description)
        <p class="mt-1 text-sm text-zinc-500">{{ $description }}</p>
    @endif

    <div class="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900" @if ($vueCode) data-code-tabs @endif>
        <div class="dot-grid flex flex-wrap items-center justify-center gap-3 border-b border-white/5 p-10">
            {{ $slot }}
        </div>
        @if ($vueCode)
            <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                <x-code-tab panel="blade" active>Blade</x-code-tab>
                <x-code-tab panel="vue">Vue</x-code-tab>
            </div>
            <div data-code-panel="blade"><x-code-block :code="$code" /></div>
            <div data-code-panel="vue" class="hidden"><x-code-block :code="$vueCode" /></div>
        @else
            <x-code-block :code="$code" />
        @endif
    </div>
</section>
