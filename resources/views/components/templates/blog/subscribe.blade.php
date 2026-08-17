@props([
    'title' => 'Get the next one',
    'note' => null,
    'compact' => false,
    'cadence' => true,
])

@php
    $options = [
        ['value' => 'every', 'label' => 'Every note', 'detail' => 'Roughly two a month.'],
        ['value' => 'digest', 'label' => 'Monthly digest', 'detail' => 'One mail, first Tuesday.'],
    ];
@endphp

<section data-subscribe {{ $attributes->class(['rounded-2xl border border-white/8 bg-ink-900', $compact ? 'p-5' : 'p-6 sm:p-7']) }}>
    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Bench Notes</p>
    <h2 @class(['font-semibold tracking-tight text-cream', 'mt-2 text-lg' => ! $compact, 'mt-1.5 text-[15px]' => $compact])>{{ $title }}</h2>

    @if ($note)
        <p @class(['text-zinc-500', 'mt-2 max-w-md text-sm/6' => ! $compact, 'mt-1.5 text-[13px]/6' => $compact])>{{ $note }}</p>
    @endif

    @if ($cadence)
        <div class="mt-4 grid gap-2.5 sm:grid-cols-2">
            @foreach ($options as $option)
                <label class="flex cursor-pointer items-start gap-2.5 rounded-xl border border-white/10 bg-ink-950 p-3.5 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
                    <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                        <input type="radio" name="cadence" value="{{ $option['value'] }}" @checked($loop->first)
                            class="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                        <span class="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
                    </span>

                    <span class="flex min-w-0 flex-col gap-0.5">
                        <span class="text-[13px]/5 text-zinc-200">{{ $option['label'] }}</span>
                        <span class="text-xs/5 text-zinc-500">{{ $option['detail'] }}</span>
                    </span>
                </label>
            @endforeach
        </div>
    @endif

    <form class="mt-4 flex flex-wrap items-center gap-2.5" onsubmit="return false">
        <input type="email" placeholder="you@workshop.tw" aria-label="Email address"
            class="h-9 min-w-0 flex-1 rounded-lg border border-white/10 bg-ink-950 px-3 text-[13px] text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500">
        <x-ui.button size="sm" type="submit">Subscribe</x-ui.button>
    </form>

    <p class="mt-3 font-mono text-[10px]/5 text-zinc-600">
        One click to leave, no reason asked. The list lives in a spreadsheet the workshop owns.
    </p>
</section>
