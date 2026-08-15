@props(['name', 'variants', 'soon' => false])
@php
    $tag = $soon ? 'div' : 'a';
@endphp
<{{ $tag }} {{ $attributes->merge(['class' => 'rise group overflow-hidden rounded-xl border border-white/8 bg-ink-900 transition-colors duration-150'.($soon ? '' : ' hover:border-jade-500/60')]) }}>
    <div class="dot-grid grid h-40 place-items-center border-b border-white/5 {{ $soon ? 'opacity-60 grayscale-25' : '' }}">
        {{ $slot }}
    </div>
    <div class="flex items-center justify-between px-4 py-3">
        <h3 class="text-sm font-medium {{ $soon ? 'text-zinc-500' : 'text-cream' }}">{{ $name }}</h3>
        @if ($soon)
            <span class="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] tracking-wider text-zinc-500 uppercase">Soon</span>
        @else
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $variants) }} variants</span>
        @endif
    </div>
</{{ $tag }}>
