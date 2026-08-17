@php
    $groups = [
        [
            'label' => 'Hoppers and dosing',
            'note' => 'what the coffee goes through',
            'options' => [
                ['option' => 'hopper', 'code' => 'SDH', 'label' => 'Single-dose hopper, 60 g', 'detail' => 'Bellows lid, 12° cone. The one the grinder is designed around.', 'price' => 0, 'included' => true],
                ['option' => 'bin', 'code' => 'BIN', 'label' => 'Bin hopper, 1.2 kg', 'detail' => 'For a bar that runs one roast all day. Swaps in without tools.', 'price' => 84, 'lead' => 'in stock'],
                ['option' => 'cup', 'code' => 'CUP', 'label' => 'Dosing cup, 58 mm', 'detail' => 'Stainless, magnetic base, sits under the chute.', 'price' => 36, 'checked' => true, 'lead' => 'in stock'],
                ['option' => 'knock', 'code' => 'KNB', 'label' => 'Knock box, walnut collar', 'detail' => 'Rubber bar, quiet enough for an open kitchen.', 'price' => 42, 'lead' => 'ships in 3 days'],
            ],
        ],
        [
            'label' => 'Keeping it true',
            'note' => 'parts, not a service plan',
            'options' => [
                ['option' => 'brush', 'code' => 'BRS', 'label' => 'Burr brush and burr tool', 'detail' => 'Both live in the base. Replacements are $9.', 'price' => 0, 'included' => true],
                ['option' => 'shims', 'code' => 'SHM', 'label' => 'Alignment shim kit', 'detail' => '0.05, 0.1 and 0.2 mm, plus the marker pen method printed on the card.', 'price' => 28, 'checked' => true, 'lead' => 'in stock'],
                ['option' => 'burrs', 'code' => 'SPB', 'label' => 'Spare burr set, 83 mm', 'detail' => 'Same coating. Worth having on the shelf if you grind more than 8 kg a week.', 'price' => 210, 'lead' => 'in stock'],
                ['option' => 'tablets', 'code' => 'TAB', 'label' => 'Cleaning tablets, 12 pack', 'detail' => 'Grain based, no rinse cycle needed after.', 'price' => 18, 'lead' => 'in stock'],
            ],
        ],
        [
            'label' => 'After it lands',
            'note' => 'optional, and cancellable',
            'options' => [
                ['option' => 'warranty', 'code' => 'W48', 'label' => 'Warranty to four years', 'detail' => 'Extends the machine cover, not the burrs — those are five years already.', 'price' => 120, 'lead' => 'added to your order'],
                ['option' => 'setup', 'code' => 'SET', 'label' => 'Bench setup, Taipei and New Taipei', 'detail' => 'An hour on site: zero point, first dial-in on your beans, and the cleaning routine with whoever opens.', 'price' => 90, 'lead' => 'booked after it ships'],
            ],
        ],
    ];

    $lines = collect($groups)->flatMap(fn (array $group): array => $group['options'])->all();
@endphp

<x-templates.product.shell active="Configure">
    <div data-product-config class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
        <div class="flex flex-col gap-6">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-cream">Build the setup, then buy it once</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    Everything here ships in the same box and carries the same return window. Nothing is a subscription, and nothing here is required to use the grinder.
                </p>
            </div>

            <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                    <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Finish</h2>
                    <span class="font-mono text-[10px] text-zinc-600">Jade is anodised in batches of 60</span>
                </div>

                <div class="p-5">
                    <x-templates.product.finish-picker detailed />
                    <p class="mt-3 font-mono text-[10px] text-zinc-600">
                        <span class="hidden group-data-[finish=graphite]/shell:inline">Graphite and Cream ship from stock. Both are the same $1,180.</span>
                        <span class="hidden group-data-[finish=cream]/shell:inline">Cream shows workshop marks less than Graphite does. Same $1,180.</span>
                        <span class="hidden group-data-[finish=jade]/shell:inline">Jade adds $120 and waits for batch 07. You are charged when it ships.</span>
                    </p>
                </div>
            </section>

            @foreach ($groups as $group)
                <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                        <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">{{ $group['label'] }}</h2>
                        <span class="font-mono text-[10px] text-zinc-600">{{ $group['note'] }}</span>
                    </div>

                    <div class="flex flex-col divide-y divide-white/5">
                        @foreach ($group['options'] as $option)
                            <x-templates.product.option-row
                                :option="$option['option']"
                                :label="$option['label']"
                                :detail="$option['detail']"
                                :price="$option['price']"
                                :checked="$option['checked'] ?? false"
                                :included="$option['included'] ?? false"
                                :lead="$option['lead'] ?? null" />
                        @endforeach
                    </div>
                </section>
            @endforeach

            <p class="font-mono text-[10px]/5 text-zinc-600">
                Prices include tax. Anything on this page can come off the order up to the moment it is packed — reply to the confirmation email and it is done.
            </p>
        </div>

        <aside class="flex flex-col gap-4 lg:sticky lg:top-32">
            <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div class="flex items-baseline justify-between gap-4 border-b border-white/5 px-5 py-4">
                    <h2 class="text-base font-medium text-cream">Your build</h2>
                    <span data-config-code class="font-mono text-[10px] text-jade-400">EG83-GRA</span>
                </div>

                <ul class="flex flex-col divide-y divide-white/5">
                    <li class="flex items-baseline gap-3 px-5 py-3">
                        <span class="text-[13px] text-zinc-300">EG-83 grinder</span>
                        <span class="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">$1,180</span>
                    </li>

                    <li data-line="finish" class="hidden items-baseline gap-3 px-5 py-3 group-data-[finish=jade]/shell:flex">
                        <span class="text-[13px] text-zinc-300">Jade finish</span>
                        <span class="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">$120</span>
                    </li>

                    @foreach ($lines as $line)
                        <li data-line="{{ $line['option'] }}" @class(['items-baseline gap-3 px-5 py-3', 'flex' => ($line['included'] ?? false) || ($line['checked'] ?? false), 'hidden' => ! ($line['included'] ?? false) && ! ($line['checked'] ?? false)])>
                            <span class="min-w-0 flex-1 truncate text-[13px] text-zinc-300">{{ $line['label'] }}</span>
                            <span class="shrink-0 font-mono text-[13px] text-zinc-400">{{ ($line['included'] ?? false) ? 'included' : '$'.number_format($line['price']) }}</span>
                        </li>
                    @endforeach

                    <li class="flex items-baseline gap-3 px-5 py-3">
                        <span class="text-[13px] text-zinc-300">Express shipping</span>
                        <span class="ml-auto shrink-0 font-mono text-[13px] text-jade-400">free</span>
                    </li>
                </ul>

                <div class="border-t border-white/8 bg-ink-950 px-5 py-4">
                    <div class="flex items-baseline justify-between gap-4">
                        <span class="text-[13px] text-cream">Total</span>
                        <span data-config-total class="font-mono text-2xl text-cream">$1,244</span>
                    </div>
                    <p class="mt-1 text-right font-mono text-[10px] text-zinc-600">
                        or 6 × <span data-config-instalment>$207.33</span> at 0%
                    </p>

                    <x-ui.button class="mt-4 w-full">Add the build to cart</x-ui.button>

                    <p class="mt-3 text-center font-mono text-[10px] text-zinc-600">
                        <span class="hidden group-data-[finish=graphite]/shell:inline">leaves the workshop tomorrow</span>
                        <span class="hidden group-data-[finish=cream]/shell:inline">leaves the workshop tomorrow</span>
                        <span class="hidden group-data-[finish=jade]/shell:inline">batch 07 · charged when it ships</span>
                        · 30-day returns
                    </p>
                </div>
            </section>

            <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Buying for a bar</p>
                <p class="mt-2.5 text-[13px]/6 text-zinc-400">
                    Three or more units gets a quote with net-30 terms, a spare burr set thrown in, and one setup visit per site.
                </p>
                <a href="{{ route('templates.screen', ['pricing', 'enterprise']) }}" target="_top"
                    class="mt-4 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Ask for a quote →</a>
            </div>

            <p class="px-1 font-mono text-[10px]/5 text-zinc-600">
                What this leaves out: a bench, a scale that reads to 0.1 g, and beans. We sell none of those and will happily tell you what we use.
            </p>
        </aside>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-product-config]');

            if (!root) {
                return;
            }

            const shell = root.closest('[data-finish]');

            const BASE = { graphite: 1180, cream: 1180, jade: 1300 };
            const CODES = { graphite: 'GRA', cream: 'CRM', jade: 'JDE' };
            const OPTION_CODES = @json(collect($lines)->mapWithKeys(fn (array $line): array => [$line['option'] => $line['code']])->all());

            const money = (value) => '$' + value.toLocaleString('en-US');
            const inputs = [...root.querySelectorAll('[data-option]')];

            const render = () => {
                const finish = shell.dataset.finish;
                let total = BASE[finish] ?? BASE.graphite;
                const code = ['EG83', CODES[finish] ?? CODES.graphite];

                inputs.forEach((input) => {
                    const line = root.querySelector('[data-line="' + input.dataset.option + '"]');
                    const price = Number(input.dataset.price);

                    line.classList.toggle('hidden', !input.checked);
                    line.classList.toggle('flex', input.checked);

                    if (!input.checked) {
                        return;
                    }

                    total += price;

                    if (price > 0) {
                        code.push(OPTION_CODES[input.dataset.option]);
                    }
                });

                root.querySelector('[data-config-total]').textContent = money(total);
                root.querySelector('[data-config-instalment]').textContent = '$' + (total / 6).toFixed(2);
                root.querySelector('[data-config-code]').textContent = code.join('-');
            };

            root.addEventListener('change', (event) => {
                if (event.target.matches('[data-option]')) {
                    render();
                }
            });

            shell.addEventListener('click', (event) => {
                if (event.target.closest('[data-finish-set]')) {
                    requestAnimationFrame(render);
                }
            });

            render();
        })();
    </script>
</x-templates.product.shell>
