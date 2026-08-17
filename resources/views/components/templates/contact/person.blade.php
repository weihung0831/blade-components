@props([
    'name',
    'initials' => null,
    'role' => null,
    'handles' => null,
    'hours' => null,
    'here' => false,
])

<div {{ $attributes->class('flex gap-3') }}>
    <span @class([
        'relative flex size-9 shrink-0 items-center justify-center rounded-lg font-mono text-[11px]',
        'border border-jade-500/40 bg-jade-500/10 text-jade-300' => $here,
        'border border-white/10 bg-ink-900 text-zinc-500' => ! $here,
    ])>
        {{ $initials ?? Illuminate\Support\Str::substr($name, 0, 2) }}
        @if ($here)
            <span class="absolute -top-0.5 -right-0.5 size-2 rounded-full border-2 border-ink-950 bg-jade-400"></span>
        @endif
    </span>

    <div class="min-w-0 flex-1">
        <p class="flex items-baseline gap-2">
            <span class="text-[13px] text-zinc-300">{{ $name }}</span>
            @if ($role)
                <span class="truncate font-mono text-[10px] text-zinc-700">{{ $role }}</span>
            @endif
        </p>

        @if ($handles)
            <p class="mt-1 text-[12px]/5 text-zinc-500">{{ $handles }}</p>
        @endif

        @if ($hours)
            <p class="mt-1 font-mono text-[10px] {{ $here ? 'text-jade-400/80' : 'text-zinc-700' }}">{{ $hours }}</p>
        @endif
    </div>
</div>
