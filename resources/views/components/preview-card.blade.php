@props(['name', 'variants'])
<a {{ $attributes->merge(['href' => '#', 'class' => 'rise group overflow-hidden rounded-xl border border-white/8 bg-ink-900 transition-colors duration-150 hover:border-white/20']) }}>
    <div class="dot-grid grid h-40 place-items-center border-b border-white/5">
        {{ $slot }}
    </div>
    <div class="flex items-center justify-between px-4 py-3">
        <h3 class="text-sm font-medium text-cream">{{ $name }}</h3>
        <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $variants) }} variants</span>
    </div>
</a>
