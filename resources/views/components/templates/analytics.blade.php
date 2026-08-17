<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 p-2.5 shadow-xl shadow-black/40">
    <div class="flex gap-1">
        <span class="h-4 w-14 rounded border border-jade-500/30 bg-jade-500/10"></span>
        <span class="h-4 w-10 rounded border border-white/10 bg-ink-900"></span>
        <span class="h-4 w-8 rounded border border-dashed border-white/10"></span>
        <span class="ml-auto h-4 w-9 rounded border border-white/10 bg-ink-900"></span>
    </div>

    <div class="mt-2 min-h-0 flex-1 rounded-md border border-white/10 bg-ink-900 p-2">
        <svg class="h-full w-full" viewBox="0 0 100 30" preserveAspectRatio="none" fill="none">
            <path d="M0 26 L14 20 L28 23 L42 14 L56 17 L70 8 L84 11 L100 3" stroke="#4ea396" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M0 26 L14 20 L28 23 L42 14 L56 17 L70 8 L84 11 L100 3 V30 H0 Z" fill="#4ea396" opacity="0.12"/>
        </svg>
    </div>

    <div class="mt-2 grid shrink-0 grid-cols-6 gap-0.5">
        @foreach ([90, 62, 44, 34, 26, 20, 90, 58, 40, 30, 22, 0] as $cell)
            <span class="h-3 rounded-[3px] {{ $cell === 0 ? 'border border-dashed border-white/10' : 'bg-jade-500' }}"
                @if ($cell !== 0) style="opacity: {{ round(0.1 + ($cell / 100) * 0.8, 2) }}" @endif></span>
        @endforeach
    </div>
</div>
