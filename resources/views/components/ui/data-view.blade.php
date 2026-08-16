@props([
    'items' => [],
    'view' => 'list',
    'name' => null,
])

@php
    $name ??= 'data-view-'.uniqid();
@endphp

<div {{ $attributes->merge(['class' => 'group/dv w-full']) }}>
    <div class="mb-3 flex justify-end">
        <div class="inline-flex rounded-lg border border-white/10 bg-ink-950 p-0.5">
            <label class="grid cursor-pointer place-items-center rounded-md px-2 py-1 text-zinc-500 transition-colors duration-150 hover:text-zinc-300 has-[:checked]:bg-white/10 has-[:checked]:text-cream has-[:focus-visible]:ring-2 has-[:focus-visible]:ring-jade-500/70">
                <input type="radio" name="{{ $name }}" value="list" @checked($view !== 'grid') class="sr-only">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M2.5 4h11M2.5 8h11M2.5 12h11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </label>
            <label class="grid cursor-pointer place-items-center rounded-md px-2 py-1 text-zinc-500 transition-colors duration-150 hover:text-zinc-300 has-[:checked]:bg-white/10 has-[:checked]:text-cream has-[:focus-visible]:ring-2 has-[:focus-visible]:ring-jade-500/70">
                <input data-ui-view-grid type="radio" name="{{ $name }}" value="grid" @checked($view === 'grid') class="sr-only">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><rect x="2.5" y="2.5" width="4.5" height="4.5" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="9" y="2.5" width="4.5" height="4.5" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="2.5" y="9" width="4.5" height="4.5" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="9" y="9" width="4.5" height="4.5" rx="1" stroke="currentColor" stroke-width="1.5"/></svg>
            </label>
        </div>
    </div>
    <div class="flex flex-col gap-2 group-has-[[data-ui-view-grid]:checked]/dv:grid group-has-[[data-ui-view-grid]:checked]/dv:grid-cols-2">
        @foreach ($items as $item)
            <div class="flex items-center gap-3 rounded-lg border border-white/10 bg-ink-800 p-3">
                <span @class(['grid size-10 shrink-0 place-items-center rounded-md font-mono text-[11px]', 'bg-jade-500/15 text-jade-400' => $item['accent'] ?? false, 'bg-white/5 text-zinc-400' => ! ($item['accent'] ?? false)])>{{ $item['badge'] }}</span>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-[13px] font-medium text-zinc-200">{{ $item['title'] }}</p>
                    <p class="truncate text-xs text-zinc-500">{{ $item['subtitle'] }}</p>
                </div>
                <span @class(['font-mono text-xs', 'text-jade-400' => $item['accent'] ?? false, 'text-zinc-400' => ! ($item['accent'] ?? false)])>{{ $item['meta'] }}</span>
            </div>
        @endforeach
    </div>
</div>
