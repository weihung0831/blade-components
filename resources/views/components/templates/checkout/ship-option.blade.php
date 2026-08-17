@props([
    'value',
    'label',
    'detail' => null,
    'price' => 0,
    'eta',
    'checked' => false,
    'note' => null,
])

<label class="flex cursor-pointer items-start gap-3 rounded-xl border border-white/10 bg-ink-950 p-4 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
    <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
        <input type="radio" name="ship" value="{{ $value }}" data-ship-set="{{ $value }}" @checked($checked)
            class="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">
        <span class="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
    </span>

    <span class="flex min-w-0 flex-1 flex-col gap-1">
        <span class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
            <span class="text-[13px]/5 text-zinc-200">{{ $label }}</span>
            <span @class(['shrink-0 font-mono text-[13px]', 'text-jade-400' => $price === 0, 'text-zinc-300' => $price > 0])>{{ $price === 0 ? 'free' : '$'.number_format($price) }}</span>
        </span>

        @if ($detail)
            <span class="text-xs/5 text-zinc-500">{{ $detail }}</span>
        @endif

        <span class="font-mono text-[10px] text-zinc-600">{{ $eta }}</span>

        @if ($note)
            <span class="font-mono text-[10px] text-amber-400/80">{{ $note }}</span>
        @endif
    </span>
</label>
