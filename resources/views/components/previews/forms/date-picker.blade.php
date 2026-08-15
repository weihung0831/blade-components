<div class="w-44 rounded-lg border border-white/10 bg-ink-800 p-2.5 text-center shadow-lg shadow-black/40">
    <div class="flex items-center justify-between px-1 text-xs text-zinc-300">
        <span class="text-zinc-600">‹</span> August 2026 <span class="text-zinc-600">›</span>
    </div>
    <div class="mt-2 grid grid-cols-7 gap-y-1 font-mono text-[10px] text-zinc-500">
        @foreach (range(9, 22) as $day)
            <span class="grid size-5 place-items-center justify-self-center rounded-full {{ $day === 15 ? 'bg-jade-500 font-medium text-ink-950' : ($day > 15 ? 'text-zinc-600' : '') }}">{{ $day }}</span>
        @endforeach
    </div>
</div>
