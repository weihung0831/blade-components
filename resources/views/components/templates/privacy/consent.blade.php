@props([
    'key',
    'name',
    'state' => 'off',
    'lead',
    'breaks',
    'items' => [],
])

@php
    $locked = $state === 'locked';
    $on = $state === 'on' || $locked;
@endphp

<section data-consent="{{ $key }}"
    @if ($on) data-on @endif
    @if ($locked) data-locked @endif
    {{ $attributes->class('flex flex-col gap-3.5 px-4 py-4 sm:flex-row sm:gap-5') }}>

    <div class="order-2 min-w-0 flex-1 sm:order-1">
        <div class="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
            <h3 class="text-[13px] text-cream">{{ $name }}</h3>
            @if ($locked)
                <span class="font-mono text-[10px] text-zinc-600">no switch — it is how the shop works</span>
            @else
                <span data-consent-state class="font-mono text-[10px] {{ $on ? 'text-jade-400/90' : 'text-zinc-600' }}">{{ $on ? 'on' : 'off by default' }}</span>
            @endif
        </div>

        <p class="mt-1.5 text-[12px]/5 text-zinc-400">{{ $lead }}</p>

        <p class="mt-2 border-l-2 border-white/10 pl-2.5 text-[11px]/5 text-zinc-500">
            <span class="font-mono text-[10px] text-zinc-700 uppercase">Without it</span><br>
            {{ $breaks }}
        </p>

        @if ($items !== [])
            <dl class="mt-2.5 flex flex-wrap gap-x-4 gap-y-1">
                @foreach ($items as $item)
                    <div class="flex items-baseline gap-1.5">
                        <dt class="font-mono text-[10px] text-zinc-500">{{ $item['name'] }}</dt>
                        <dd class="font-mono text-[10px] text-zinc-700">{{ $item['life'] }}</dd>
                    </div>
                @endforeach
            </dl>
        @endif
    </div>

    <div class="order-1 shrink-0 sm:order-2 sm:pt-0.5">
        <label @class([
            'inline-flex items-center gap-2.5',
            'pointer-events-none opacity-50' => $locked,
            'cursor-pointer' => ! $locked,
        ])>
            <input type="checkbox" role="switch"
                data-consent-input
                aria-label="{{ $name }}"
                class="peer sr-only"
                @if ($on) checked @endif
                @if ($locked) disabled @endif>

            <span class="relative h-5 w-9 rounded-full border border-white/10 bg-ink-800 transition-colors duration-200 ease-snap peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70 after:absolute after:top-1 after:left-1 after:size-2.5 after:rounded-full after:bg-zinc-400 after:transition-[translate,background-color] after:duration-200 after:ease-snap peer-checked:after:translate-x-4 peer-checked:after:bg-ink-950"></span>
        </label>
    </div>
</section>
