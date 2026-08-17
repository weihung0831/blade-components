@props([
    'name',
    'role' => null,
    'date' => null,
    'read' => null,
    'initials' => null,
    'bio' => null,
    'size' => 'sm',
])

@php
    $large = $size === 'lg';
    $mark = $initials ?? Illuminate\Support\Str::of($name)->explode(' ')->take(2)->map(fn (string $part): string => Illuminate\Support\Str::substr($part, 0, 1))->implode('');
@endphp

<div {{ $attributes->class(['flex', $large ? 'gap-4' : 'items-center gap-3']) }}>
    <span @class([
        'grid shrink-0 place-items-center rounded-full border border-jade-500/30 bg-jade-500/10 font-mono text-jade-300 uppercase',
        'size-12 text-sm' => $large,
        'size-8 text-[11px]' => ! $large,
    ])>{{ $mark }}</span>

    <div class="flex min-w-0 flex-col">
        <div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5">
            <span @class(['text-cream', 'text-[15px] font-medium' => $large, 'text-[13px]' => ! $large])>{{ $name }}</span>
            @if ($role)
                <span class="font-mono text-[10px] text-zinc-600">{{ $role }}</span>
            @endif
        </div>

        @if ($date || $read)
            <p class="mt-0.5 flex flex-wrap items-center gap-x-2 gap-y-0.5 font-mono text-[10px] text-zinc-600">
                @if ($date)
                    <span>{{ $date }}</span>
                @endif
                @if ($date && $read)
                    <span aria-hidden="true" class="size-1 rounded-full bg-white/15"></span>
                @endif
                @if ($read)
                    <span>{{ $read }} min read</span>
                @endif
            </p>
        @endif

        @if ($bio)
            <p class="mt-2 max-w-md text-[13px]/6 text-zinc-500">{{ $bio }}</p>
        @endif

        {{ $slot }}
    </div>
</div>
