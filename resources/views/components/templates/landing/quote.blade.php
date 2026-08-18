@props([
    'body',
    'name',
    'role' => null,
    'machine' => null,
    'since' => null,
])

<figure {{ $attributes->class('flex flex-col rounded-2xl border border-white/8 bg-ink-950 p-4') }}>
    <blockquote class="text-[13px]/6 text-zinc-300">{{ $body }}</blockquote>

    <figcaption class="mt-4 flex items-center gap-3 border-t border-white/5 pt-3">
        <span class="flex size-7 shrink-0 items-center justify-center rounded-full border border-white/10 bg-ink-900 font-mono text-[10px] text-zinc-500">
            {{ Illuminate\Support\Str::of($name)->explode(' ')->map(fn ($part) => Illuminate\Support\Str::substr($part, 0, 1))->take(2)->implode('') }}
        </span>

        <span class="min-w-0 flex-1">
            <span class="block truncate text-[12px] text-cream">{{ $name }}</span>
            @if ($role)
                <span class="block truncate text-[11px] text-zinc-600">{{ $role }}</span>
            @endif
        </span>

        <span class="shrink-0 text-right">
            @if ($machine)
                <span class="block font-mono text-[10px] text-zinc-600">{{ $machine }}</span>
            @endif
            @if ($since)
                <span class="block font-mono text-[10px] text-zinc-700">{{ $since }}</span>
            @endif
        </span>
    </figcaption>
</figure>
