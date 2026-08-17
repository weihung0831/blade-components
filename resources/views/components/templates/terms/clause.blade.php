@props([
    'number',
    'title',
    'gloss' => null,
    'changed' => null,
    'bites' => false,
])

<section id="clause-{{ $number }}"
    data-clause
    @if ($changed) data-changed="{{ $changed }}" @endif
    {{ $attributes->class('scroll-mt-4 border-t border-white/5 pt-5 first:border-t-0 first:pt-0') }}>

    <div class="flex gap-3 sm:gap-5">
        <span class="w-6 shrink-0 pt-0.5 font-mono text-[13px] text-zinc-700 sm:w-8">{{ $number }}</span>

        <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1.5">
                <h2 class="text-[15px] font-medium tracking-tight text-cream">{{ $title }}</h2>

                @if ($changed)
                    <span class="rounded border border-jade-500/40 bg-jade-500/10 px-1.5 py-0.5 font-mono text-[10px] text-jade-300">rewritten in {{ $changed }}</span>
                @endif

                @if ($bites)
                    <span class="rounded border border-amber-400/30 bg-amber-400/8 px-1.5 py-0.5 font-mono text-[10px] text-amber-300/90">this one catches people out</span>
                @endif
            </div>

            <div class="mt-2 space-y-2.5 text-[13px]/6 text-zinc-400 [&_a]:text-jade-400 [&_a:hover]:text-jade-300 [&_li]:pl-1 [&_ul]:list-disc [&_ul]:space-y-1.5 [&_ul]:pl-5">
                {{ $slot }}
            </div>

            @if ($gloss)
                <p class="mt-3.5 border-l-2 border-jade-500/40 pl-3 text-[12px]/5 text-zinc-500">
                    <span class="font-mono text-[10px] text-zinc-700 uppercase">Plainly</span><br>
                    {{ $gloss }}
                </p>
            @endif
        </div>
    </div>
</section>
