@props([
    'active' => 'Cart',
])

@php
    $steps = [
        ['label' => 'Cart', 'screen' => 'cart', 'note' => 'one box'],
        ['label' => 'Delivery', 'screen' => 'delivery', 'note' => 'address'],
        ['label' => 'Payment', 'screen' => 'payment', 'note' => 'card'],
        ['label' => 'Done', 'screen' => 'confirmation', 'note' => 'receipt'],
    ];

    $index = array_search($active, array_column($steps, 'label'), true);
    $current = $index === false ? 1 : $index + 1;
@endphp

<div {{ $attributes->class('group/shell flex h-full w-full flex-col overflow-hidden bg-ink-950') }} data-ship="standard">
    <div class="relative flex min-h-0 flex-1">
        <div data-ui-scroll-region class="flex min-w-0 flex-1 flex-col overflow-y-auto">
            <header class="sticky top-0 z-30 flex h-14 shrink-0 items-center gap-4 border-b border-white/5 bg-ink-950/85 px-5 backdrop-blur sm:px-8">
                <a href="{{ route('templates.screen', ['product', 'overview']) }}" target="_top" class="flex shrink-0 items-center gap-2.5">
                    <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M7 4h10l-1.5 5.5a4.5 4.5 0 0 1-7 0L7 4Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                        <path d="M12 13v7M8.5 20h7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <span class="text-sm font-medium tracking-tight text-cream">NOMAD Supply</span>
                </a>

                <span class="hidden items-center gap-1.5 font-mono text-[10px] text-zinc-600 sm:inline-flex">
                    <svg class="size-3 text-jade-400" viewBox="0 0 16 16" fill="none">
                        <rect x="3.5" y="7" width="9" height="6" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                        <path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="currentColor" stroke-width="1.3"/>
                    </svg>
                    encrypted · 3-D Secure
                </span>

                <div class="ml-auto flex shrink-0 items-center gap-4">
                    <span class="hidden font-mono text-[10px] text-zinc-600 lg:block">cart held until 14:52</span>

                    <a href="{{ route('templates.screen', ['product', 'configure'])}}" target="_top"
                        class="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">Keep shopping</a>
                </div>
            </header>

            <div class="sticky top-14 z-20 border-b border-white/5 bg-ink-950/85 backdrop-blur">
                <div class="mx-auto w-full max-w-6xl px-5 sm:px-8">
                    <ol class="flex items-stretch gap-1 overflow-x-auto py-2.5">
                        @foreach ($steps as $step)
                            @php $number = $loop->iteration; @endphp
                            <li class="flex shrink-0 items-center gap-1">
                                <a href="{{ route('templates.screen', ['checkout', $step['screen']]) }}" target="_top"
                                    @if ($number === $current) aria-current="step" @endif
                                    @class([
                                        'flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                                        'bg-white/8' => $number === $current,
                                        'hover:bg-white/5' => $number !== $current,
                                    ])>
                                    <span @class([
                                        'grid size-6 shrink-0 place-items-center rounded-full font-mono text-[11px]',
                                        'bg-jade-500 text-ink-950' => $number < $current,
                                        'border border-jade-500 text-jade-400' => $number === $current,
                                        'border border-white/15 text-zinc-600' => $number > $current,
                                    ])>
                                        @if ($number < $current)
                                            <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        @else
                                            {{ $number }}
                                        @endif
                                    </span>

                                    <span class="flex flex-col">
                                        <span @class(['text-[13px]/4', 'text-cream' => $number === $current, 'text-zinc-400' => $number < $current, 'text-zinc-600' => $number > $current])>{{ $step['label'] }}</span>
                                        <span class="font-mono text-[10px] text-zinc-600">{{ $step['note'] }}</span>
                                    </span>
                                </a>

                                @unless ($loop->last)
                                    <span aria-hidden="true" @class(['h-px w-5 shrink-0', 'bg-jade-500/50' => $number < $current, 'bg-white/10' => $number >= $current])></span>
                                @endunless
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <main class="mx-auto w-full max-w-6xl grow px-5 py-8 sm:px-8">{{ $slot }}</main>

            <footer class="border-t border-white/5 bg-ink-900/50">
                <div class="mx-auto flex w-full max-w-6xl flex-wrap items-center gap-x-5 gap-y-3 px-5 py-6 font-mono text-[10px] text-zinc-600 sm:px-8">
                    <span>© 2026 NOMAD Supply Co. · tax ID 24681357</span>
                    <a href="#" class="transition-colors duration-150 hover:text-cream">Returns</a>
                    <a href="#" class="transition-colors duration-150 hover:text-cream">Privacy</a>
                    <a href="#" class="transition-colors duration-150 hover:text-cream">Reach a person</a>
                    <span class="ml-auto inline-flex items-center gap-1.5">
                        <span class="size-1.5 rounded-full bg-jade-400"></span>
                        payments settling normally
                    </span>
                </div>
            </footer>
        </div>

        <x-ui.scroll-top anchor="container" variant="progress" :threshold="300" />
    </div>
</div>

@once
    <script>
        document.addEventListener('change', (event) => {
            const input = event.target.closest('[data-ship-set]');

            if (input) {
                input.closest('[data-ship]').dataset.ship = input.dataset.shipSet;
            }
        });
    </script>
@endonce
