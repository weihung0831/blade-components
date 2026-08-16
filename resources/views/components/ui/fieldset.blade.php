@props(['legend', 'toggleable' => false, 'open' => true])

@if ($toggleable)
    <fieldset {{ $attributes->merge(['class' => 'group/fieldset rounded-xl border border-white/10 px-4 pt-1.5 pb-1.5']) }}>
        <legend class="px-2">
            <label class="flex cursor-pointer items-center gap-2 rounded text-sm font-medium text-zinc-200 transition-colors duration-150 hover:text-cream has-focus-visible:ring-2 has-focus-visible:ring-jade-500/70">
                <input type="checkbox" @checked($open) class="peer sr-only">
                {{ $legend }}
                <svg class="size-3.5 text-zinc-500 transition-transform duration-200 ease-snap peer-checked:rotate-180 peer-checked:text-jade-400" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </label>
        </legend>
        <div class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-200 ease-snap group-has-checked/fieldset:grid-rows-[1fr]">
            <div class="overflow-hidden">
                <div class="pt-1 pb-2.5">{{ $slot }}</div>
            </div>
        </div>
    </fieldset>
@else
    <fieldset {{ $attributes->merge(['class' => 'rounded-xl border border-white/10 px-4 pt-1.5 pb-4']) }}>
        <legend class="px-2 text-sm font-medium text-zinc-200">{{ $legend }}</legend>
        <div class="pt-1">{{ $slot }}</div>
    </fieldset>
@endif
