<div class="flex items-center gap-1.5">
    @foreach ([true, true, true, true, false] as $filled)
        <svg class="size-4.5 {{ $filled ? 'text-jade-400' : 'text-white/15' }}" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1.5l1.9 3.9 4.3.6-3.1 3 .7 4.3L8 11.3l-3.8 2 .7-4.3-3.1-3 4.3-.6L8 1.5Z"/></svg>
    @endforeach
    <span class="ml-1 font-mono text-xs text-zinc-500">4.0</span>
</div>
