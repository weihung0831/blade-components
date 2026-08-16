@php
    $presets = [
        ['label' => 'Single storefront', 'meta' => '8 seats', 'values' => ['seats' => 8, 'api' => 800, 'storage' => 150, 'bandwidth' => 750]],
        ['label' => 'Regional brand', 'meta' => '312 seats', 'values' => ['seats' => 312, 'api' => 8400, 'storage' => 600, 'bandwidth' => 3000]],
        ['label' => 'Marketplace', 'meta' => '640 seats', 'values' => ['seats' => 640, 'api' => 34000, 'storage' => 3200, 'bandwidth' => 16000]],
    ];

    $cards = [
        ['key' => 'launch', 'name' => 'Launch', 'total' => 'Over the limits', 'sub' => '25 seats, 2M calls', 'note' => 'Caps out well before this workspace does.'],
        ['key' => 'scale', 'name' => 'Scale', 'total' => '$4,984.00', 'sub' => 'per month', 'note' => 'Everything sits inside the included limits.'],
        ['key' => 'enterprise', 'name' => 'Enterprise', 'total' => 'Quoted', 'sub' => 'from 500 seats', 'note' => 'Worth a call once seats pass 500 or calls pass 30M.'],
    ];

    $lines = [
        ['key' => 'fee', 'label' => 'Platform fee', 'detail' => 'Scale, monthly', 'amount' => '$1,240.00'],
        ['key' => 'seats', 'label' => 'Seats', 'detail' => '312 × $12.00', 'amount' => '$3,744.00'],
        ['key' => 'api', 'label' => 'API calls', 'detail' => '8.4M of 12M included', 'amount' => '$0.00'],
        ['key' => 'storage', 'label' => 'Asset storage', 'detail' => '600 GB of 1 TB included', 'amount' => '$0.00'],
        ['key' => 'bandwidth', 'label' => 'Bandwidth', 'detail' => '2.9 TB of 5 TB included', 'amount' => '$0.00'],
    ];
@endphp

<x-templates.pricing.shell active="Calculator" title="Four numbers in, three plans costed, one invoice out."
    description="Pull last month's figures off the usage panel and drag. The estimate assumes the usage repeats — it is arithmetic, not a forecast.">
    <div data-pricing-calc class="grid items-start gap-6 lg:grid-cols-[22rem_minmax(0,1fr)]">
        <aside class="flex flex-col gap-6 rounded-2xl border border-white/8 bg-ink-900 p-6 lg:sticky lg:top-20">
            <div>
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Your workspace</p>
                <p class="mt-2 text-[13px]/6 text-zinc-500">Seats are the number that moves the total. Everything else stays inside the included limits for most merchants.</p>
            </div>

            <x-templates.pricing.dial field="seats" label="Seats" hint="warehouse and support staff each need one"
                :min="5" :max="1200" :step="1" :value="312" display="312" />

            <x-templates.pricing.dial field="api" label="API calls" hint="storefront reads, orders, and webhooks out"
                :min="200" :max="40000" :step="200" :value="8400" format="calls" display="8.4M" />

            <x-templates.pricing.dial field="storage" label="Asset storage" hint="product images, invoices, exports"
                :min="50" :max="4000" :step="50" :value="600" format="bytes" display="600 GB" />

            <x-templates.pricing.dial field="bandwidth" label="Bandwidth" hint="everything served from the edge"
                :min="250" :max="20000" :step="250" :value="3000" format="bytes" display="2.9 TB" />

            <div class="border-t border-white/5 pt-5">
                <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Start from a shape</p>
                <div class="mt-3 flex flex-col gap-1.5">
                    @foreach ($presets as $preset)
                        <button type="button" data-calc-preset="{{ json_encode($preset['values']) }}"
                            class="flex items-center gap-2 rounded-lg border border-white/8 px-3 py-2 text-left text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/40 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                            {{ $preset['label'] }}
                            <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ $preset['meta'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </aside>

        <div class="flex flex-col gap-6">
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ($cards as $card)
                    <article data-calc-plan="{{ $card['key'] }}" @if ($card['key'] === 'scale') data-recommended @endif
                        class="rounded-2xl border border-white/8 bg-ink-900 p-5 transition-colors duration-200 data-recommended:border-jade-500/40 data-recommended:bg-jade-500/6">
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-[13px] font-medium text-zinc-300">{{ $card['name'] }}</span>
                            <span data-calc-flag @class(['font-mono text-[10px] text-jade-400', 'hidden' => $card['key'] !== 'scale'])>recommended</span>
                        </div>

                        <p data-calc-total class="mt-3 font-mono text-xl text-cream">{{ $card['total'] }}</p>
                        <p data-calc-sub class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $card['sub'] }}</p>
                        <p data-calc-note class="mt-3 text-[11px]/5 text-zinc-500">{{ $card['note'] }}</p>
                    </article>
                @endforeach
            </div>

            <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-4">
                    <h2 class="text-base font-medium text-cream">Estimated invoice</h2>
                    <p data-calc-caption class="font-mono text-[11px] text-zinc-600">Scale · billed monthly on the 1st</p>
                </div>

                <ul class="flex flex-col divide-y divide-white/5">
                    @foreach ($lines as $line)
                        <li data-calc-line="{{ $line['key'] }}" class="flex items-baseline gap-4 px-5 py-3">
                            <span class="text-[13px] text-zinc-300">{{ $line['label'] }}</span>
                            <span data-calc-line-detail class="hidden truncate font-mono text-[11px] text-zinc-600 sm:block">{{ $line['detail'] }}</span>
                            <span data-calc-line-amount class="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">{{ $line['amount'] }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="flex flex-wrap items-baseline gap-x-4 gap-y-2 border-t border-white/8 bg-ink-950 px-5 py-4">
                    <span class="text-[13px] text-cream">Per month</span>
                    <span data-calc-alt class="font-mono text-[11px] text-zinc-600">annual would save $8,558.40 a year</span>
                    <span data-calc-grand class="ml-auto font-mono text-xl text-cream">$4,984.00</span>
                </div>
            </section>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">What this leaves out</p>
                    <p class="mt-3 text-[13px]/6 text-zinc-400">Payment processing, which your PSP bills you for directly, and tax. Sandbox storefronts never meter.</p>
                </div>

                <div class="flex flex-col justify-between rounded-2xl border border-white/8 bg-ink-900 p-5">
                    <p class="text-[13px]/6 text-zinc-400">An estimate is not a quote. Send us the numbers and we will hold a rate for 30 days.</p>
                    <a href="{{ route('templates.screen', ['pricing', 'enterprise']) }}" target="_top"
                        class="mt-4 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Ask for a quote →</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-pricing-calc]');

            if (!root) {
                return;
            }

            const shell = root.closest('[data-cycle]');

            const PLANS = {
                launch: { name: 'Launch', fee: 79, seat: 6, freeSeats: 5, minSeats: 0, api: 250, storage: 50, bandwidth: 250 },
                scale: { name: 'Scale', fee: 1240, seat: 12, freeSeats: 0, minSeats: 10, api: 12000, storage: 1024, bandwidth: 5120 },
            };

            const CEILING = { seats: 25, api: 2000, storage: 250, bandwidth: 1000 };
            const FLOOR = { seats: 500, api: 30000, storage: 3072, bandwidth: 15360 };
            const RATE = { api: 0.04, storage: 0.09, bandwidth: 0.05 };

            const dials = {};
            root.querySelectorAll('[data-calc-field]').forEach((dial) => {
                dials[dial.dataset.calcField] = dial;
            });

            const money = (value) => '$' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            const trim = (value) => Number(value.toFixed(1)).toLocaleString('en-US');
            const calls = (value) => value >= 1000 ? trim(value / 1000) + 'M' : value + 'k';
            const bytes = (value) => value >= 1024 ? trim(value / 1024) + ' TB' : value + ' GB';

            const read = () => ({
                seats: Number(dials.seats.querySelector('input').value),
                api: Number(dials.api.querySelector('input').value),
                storage: Number(dials.storage.querySelector('input').value),
                bandwidth: Number(dials.bandwidth.querySelector('input').value),
            });

            const cost = (plan, usage, discount) => {
                const fee = plan.fee * discount;
                const seatRate = plan.seat * discount;
                const seats = Math.max(usage.seats - plan.freeSeats, plan.minSeats);
                const over = {
                    api: Math.max(0, usage.api - plan.api) * RATE.api,
                    storage: Math.max(0, usage.storage - plan.storage) * RATE.storage,
                    bandwidth: Math.max(0, usage.bandwidth - plan.bandwidth) * RATE.bandwidth,
                };

                return {
                    fee,
                    seatRate,
                    seats,
                    seatCost: seats * seatRate,
                    over,
                    recurring: fee + seats * seatRate,
                    total: fee + seats * seatRate + over.api + over.storage + over.bandwidth,
                };
            };

            const overflows = (usage) => Object.keys(CEILING).filter((key) => usage[key] > CEILING[key]);
            const outgrown = (usage) => Object.keys(FLOOR).some((key) => usage[key] >= FLOOR[key]);

            const card = (key) => root.querySelector('[data-calc-plan="' + key + '"]');
            const set = (element, selector, text) => { element.querySelector(selector).textContent = text; };

            const render = () => {
                const usage = read();
                const annual = shell.dataset.cycle === 'annual';
                const discount = annual ? 0.84 : 1;

                const launch = cost(PLANS.launch, usage, discount);
                const scale = cost(PLANS.scale, usage, discount);
                const blocked = overflows(usage);
                const enterprise = outgrown(usage);
                const winner = enterprise ? 'enterprise' : (blocked.length === 0 && launch.total < scale.total ? 'launch' : 'scale');

                const launchCard = card('launch');
                set(launchCard, '[data-calc-total]', blocked.length > 0 ? 'Over the limits' : money(launch.total));
                set(launchCard, '[data-calc-sub]', blocked.length > 0 ? blocked.join(', ') + ' past the cap' : 'per month');
                set(launchCard, '[data-calc-note]', blocked.length > 0
                    ? 'Launch stops at 25 seats, 2M calls, 250 GB of assets and 1 TB out.'
                    : 'One storefront, one region, support next business day.');

                const scaleCard = card('scale');
                set(scaleCard, '[data-calc-total]', money(scale.total));
                set(scaleCard, '[data-calc-sub]', annual ? 'per month, billed yearly' : 'per month');
                set(scaleCard, '[data-calc-note]', scale.over.api + scale.over.storage + scale.over.bandwidth > 0
                    ? 'Includes ' + money(scale.over.api + scale.over.storage + scale.over.bandwidth) + ' of metered overage.'
                    : 'Everything sits inside the included limits.');

                const enterpriseCard = card('enterprise');
                set(enterpriseCard, '[data-calc-note]', enterprise
                    ? 'These numbers are past the self-serve ceiling — the rate gets negotiated.'
                    : 'Worth a call once seats pass 500 or calls pass 30M.');

                ['launch', 'scale', 'enterprise'].forEach((key) => {
                    const element = card(key);

                    element.toggleAttribute('data-recommended', key === winner);
                    element.querySelector('[data-calc-flag]').classList.toggle('hidden', key !== winner);
                });

                const plan = winner === 'launch' ? PLANS.launch : PLANS.scale;
                const bill = winner === 'launch' ? launch : scale;

                const line = (key, detail, amount) => {
                    const element = root.querySelector('[data-calc-line="' + key + '"]');

                    set(element, '[data-calc-line-detail]', detail);
                    set(element, '[data-calc-line-amount]', money(amount));
                };

                const included = (key, unit) => usage[key] > plan[key]
                    ? unit(usage[key]) + ' · ' + unit(usage[key] - plan[key]) + ' over'
                    : unit(usage[key]) + ' of ' + unit(plan[key]) + ' included';

                line('fee', plan.name + (annual ? ', 16% off' : ', monthly'), bill.fee);
                line('seats', bill.seats.toLocaleString('en-US') + ' × ' + money(bill.seatRate), bill.seatCost);
                line('api', included('api', calls), bill.over.api);
                line('storage', included('storage', bytes), bill.over.storage);
                line('bandwidth', included('bandwidth', bytes), bill.over.bandwidth);

                set(root, '[data-calc-caption]', enterprise
                    ? plan.name + ' equivalent · Enterprise is quoted, not metered'
                    : plan.name + (annual ? ' · billed once for 12 months' : ' · billed monthly on the 1st'));

                set(root, '[data-calc-grand]', money(bill.total));
                set(root, '[data-calc-alt]', annual
                    ? money(bill.recurring * 12) + ' up front, metered charges monthly'
                    : 'annual would save ' + money(bill.recurring * 12 * 0.16) + ' a year');
            };

            root.addEventListener('input', render);

            root.addEventListener('click', (event) => {
                const preset = event.target.closest('[data-calc-preset]');

                if (preset) {
                    Object.entries(JSON.parse(preset.dataset.calcPreset)).forEach(([key, value]) => {
                        const input = dials[key].querySelector('input');

                        input.value = value;
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                    });
                }
            });

            shell.addEventListener('click', (event) => {
                if (event.target.closest('[data-cycle-set]')) {
                    requestAnimationFrame(render);
                }
            });

            render();
        })();
    </script>
</x-templates.pricing.shell>
