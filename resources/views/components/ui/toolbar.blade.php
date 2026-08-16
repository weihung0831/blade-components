<div {{ $attributes->merge(['class' => 'flex items-center justify-between gap-2 rounded-xl border border-white/10 bg-ink-800 p-1.5']) }} role="toolbar">
    @isset($start)
        <div class="flex items-center gap-1">{{ $start }}</div>
    @endisset
    @isset($center)
        <div class="flex items-center gap-1">{{ $center }}</div>
    @endisset
    @isset($end)
        <div class="flex items-center gap-1.5">{{ $end }}</div>
    @endisset
</div>
