@props([
    'option',
    'label',
    'detail' => null,
    'price' => 0,
    'checked' => false,
    'included' => false,
    'lead' => null,
])

<label class="flex cursor-pointer items-start gap-3 px-5 py-3.5 transition-colors duration-150 has-[:checked]:bg-jade-500/6 has-[:disabled]:cursor-default has-[:disabled]:opacity-60">
    <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
        <input type="checkbox" data-option="{{ $option }}" data-price="{{ $price }}" @checked($checked || $included) @disabled($included)
            class="peer absolute inset-0 cursor-pointer appearance-none rounded border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 checked:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70 disabled:cursor-default">
        <svg class="pointer-events-none relative size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </span>

    <span class="min-w-0 flex-1">
        <span class="block text-[13px] text-zinc-200">{{ $label }}</span>
        @if ($detail)
            <span class="mt-0.5 block text-[12px]/5 text-zinc-500">{{ $detail }}</span>
        @endif
        @if ($lead)
            <span class="mt-1 block font-mono text-[10px] text-zinc-600">{{ $lead }}</span>
        @endif
    </span>

    <span class="shrink-0 text-right">
        <span class="block font-mono text-[13px] text-zinc-300">{{ $included ? 'included' : '+$'.number_format($price) }}</span>
    </span>
</label>
