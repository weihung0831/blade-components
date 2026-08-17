@props([
    'name',
    'slug',
    'machine' => null,
    'limit' => null,
    'count' => 0,
    'terminal' => false,
])

@php
    $fill = $limit ? min(100, round($count / $limit * 100)) : 0;
@endphp

<section data-column data-station="{{ $slug }}" @if ($limit) data-limit="{{ $limit }}" @endif
    @if ($limit && $count > $limit) data-over-limit @endif
    class="group/col flex w-72 shrink-0 flex-col transition-[width] duration-300 ease-snap data-collapsed:w-12">

    <header class="shrink-0 px-1">
        <div class="flex items-center gap-2 group-data-collapsed/col:flex-col group-data-collapsed/col:gap-3">
            <button type="button" data-column-toggle
                class="grid size-5 shrink-0 place-items-center rounded text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                <svg class="size-3.5 transition-transform duration-300 ease-snap group-data-collapsed/col:rotate-180" viewBox="0 0 16 16" fill="none">
                    <path d="M10 4 6 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="sr-only">Collapse {{ $name }}</span>
            </button>

            <h3 class="text-[13px] font-medium tracking-tight text-cream group-data-collapsed/col:[writing-mode:vertical-rl]">{{ $name }}</h3>

            <span data-column-tally class="ml-auto font-mono text-[11px] group-data-collapsed/col:ml-0 {{ $limit && $count > $limit ? 'text-red-300' : 'text-zinc-600' }}">
                <span data-column-count>{{ $count }}</span>@if ($limit)<span class="text-zinc-700">/{{ $limit }}</span>@endif
            </span>
        </div>

        <div class="mt-2.5 group-data-collapsed/col:hidden">
            @if ($limit)
                <div class="h-0.5 w-full overflow-hidden rounded-full bg-white/8">
                    <span data-wip-fill class="block h-full rounded-full bg-jade-500/70 transition-[width] duration-300 ease-snap group-data-over-limit/col:bg-red-400" style="width: {{ $fill }}%"></span>
                </div>
            @else
                <div class="h-0.5 w-full rounded-full bg-white/5"></div>
            @endif

            <p class="mt-2 flex items-center gap-1.5 font-mono text-[10px] text-zinc-700">
                @if ($machine)
                    <span class="truncate">{{ $machine }}</span>
                @endif
                @if ($limit)
                    <span data-column-warning class="ml-auto shrink-0 text-red-300 {{ $count > $limit ? '' : 'hidden' }}">over by <span data-column-excess>{{ max(0, $count - $limit) }}</span></span>
                @elseif ($terminal)
                    <span class="ml-auto shrink-0">no limit</span>
                @endif
            </p>
        </div>
    </header>

    <div data-drop
        class="mt-2.5 flex min-h-24 flex-1 flex-col gap-2.5 overflow-y-auto rounded-xl border border-dashed border-transparent p-1 transition-colors duration-150 group-data-collapsed/col:hidden data-over:border-jade-500/50 data-over:bg-jade-500/5">
        {{ $slot }}

        <p data-column-empty class="{{ $count > 0 ? 'hidden' : '' }} rounded-xl border border-dashed border-white/8 px-3 py-6 text-center font-mono text-[10px] text-zinc-700">
            drop a job here
        </p>
    </div>
</section>
