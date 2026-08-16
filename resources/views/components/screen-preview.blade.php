@props([
    'title',
    'description' => null,
    'href' => null,
    'panels' => [],
])

<section {{ $attributes }}>
    <div class="flex flex-wrap items-end justify-between gap-3">
        <div>
            <h3 class="text-base font-medium text-cream">{{ $title }}</h3>
            @if ($description)
                <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">{{ $description }}</p>
            @endif
        </div>
        @if ($href)
            <a href="{{ $href }}" target="_blank" rel="noopener"
                class="inline-flex shrink-0 items-center gap-1.5 rounded-lg border border-white/10 px-3 py-1.5 text-[13px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">
                Open full screen
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M6.5 3.5H12.5V9.5M12.5 3.5 3.5 12.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        @endif
    </div>

    <div class="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900" @if ($panels !== []) data-code-tabs @endif>
        <div class="h-[42rem] overflow-auto {{ $panels !== [] ? 'border-b border-white/5' : '' }}">
            {{ $slot }}
        </div>

        @if ($panels !== [])
            <x-code-disclosure label="Show source" close-label="Hide source" :hint="implode(' · ', array_column($panels, 'label'))">
                <x-code-panels :panels="$panels" />
            </x-code-disclosure>
        @endif
    </div>
</section>
