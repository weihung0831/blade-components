@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/pricing/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/pricing/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/pricing/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $demoFeatures = [
        ['label' => 'Unlimited storefronts', 'meta' => '+ 10 sandboxes'],
        ['label' => '12M API calls', 'meta' => 'then $0.40 per 10k'],
        ['label' => 'Three regions', 'meta' => 'ap-1 · sfo-2 · fra-1'],
        ['label' => 'Priority support', 'meta' => '4h first response'],
    ];

    $demoRates = [
        ['label' => 'API calls', 'rate' => '$0.40', 'unit' => 'per extra 10k'],
        ['label' => 'Asset storage', 'rate' => '$0.09', 'unit' => 'per extra GB'],
        ['label' => 'Bandwidth', 'rate' => '$0.05', 'unit' => 'per extra GB'],
        ['label' => 'Webhook events', 'rate' => '$2.00', 'unit' => 'per extra 100k'],
    ];

    $cardCode = <<<'BLADE'
    <x-templates.pricing.plan-card
        name="Scale"
        badge="68% of merchants"
        featured
        tagline="Every storefront you run, priced per seat, metered above the included line."
        monthly="$1,240"
        annual="$1,041"
        unit="+ $12 per seat, minimum of 10"
        annual-note="$12,492 billed once · saves $2,388"
        cta="Start on Scale"
        cta-variant="primary"
        meta="99.95% SLA with credits · plan changes prorate to the day"
        :features="[
            ['label' => 'Unlimited storefronts', 'meta' => '+ 10 sandboxes'],
            ['label' => '12M API calls', 'meta' => 'then $0.40 per 10k'],
        ]" />
    BLADE;

    $cardVueCode = <<<'VUE'
    <PricingPlanCard
        name="Scale"
        badge="68% of merchants"
        featured
        tagline="Every storefront you run, priced per seat, metered above the included line."
        monthly="$1,240"
        annual="$1,041"
        unit="+ $12 per seat, minimum of 10"
        annual-note="$12,492 billed once · saves $2,388"
        cta="Start on Scale"
        cta-variant="primary"
        meta="99.95% SLA with credits · plan changes prorate to the day"
        :features="[
            { label: 'Unlimited storefronts', meta: '+ 10 sandboxes' },
            { label: '12M API calls', meta: 'then $0.40 per 10k' },
        ]"
    />
    VUE;

    $cardReactCode = <<<'REACT'
    <PricingPlanCard
        name="Scale"
        badge="68% of merchants"
        featured
        tagline="Every storefront you run, priced per seat, metered above the included line."
        monthly="$1,240"
        annual="$1,041"
        unit="+ $12 per seat, minimum of 10"
        annualNote="$12,492 billed once · saves $2,388"
        cta="Start on Scale"
        ctaVariant="primary"
        meta="99.95% SLA with credits · plan changes prorate to the day"
        features={[
            { label: 'Unlimited storefronts', meta: '+ 10 sandboxes' },
            { label: '12M API calls', meta: 'then $0.40 per 10k' },
        ]}
    />
    REACT;

    $cycleCode = <<<'BLADE'
    <div class="group/shell" data-cycle="monthly">
        <button type="button" data-cycle-set="monthly"
            class="rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 group-data-[cycle=monthly]/shell:bg-jade-500/15 group-data-[cycle=monthly]/shell:text-jade-300">Monthly</button>
        <button type="button" data-cycle-set="annual"
            class="rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 group-data-[cycle=annual]/shell:bg-jade-500/15 group-data-[cycle=annual]/shell:text-jade-300">Annual</button>

        <p class="text-3xl font-semibold text-cream">
            <span class="group-data-[cycle=annual]/shell:hidden">$1,240</span>
            <span class="hidden group-data-[cycle=annual]/shell:inline">$1,041</span>
        </p>
    </div>

    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-cycle-set]');

            if (button) {
                button.closest('[data-cycle]').dataset.cycle = button.dataset.cycleSet;
            }
        });
    </script>
    BLADE;

    $cycleVueCode = <<<'VUE'
    <script setup>
    import { ref } from 'vue';

    const billing = ref('monthly');
    </script>

    <template>
        <div class="group/shell" :data-cycle="billing">
            <button type="button" @click="billing = 'monthly'"
                class="rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 group-data-[cycle=monthly]/shell:bg-jade-500/15 group-data-[cycle=monthly]/shell:text-jade-300">Monthly</button>
            <button type="button" @click="billing = 'annual'"
                class="rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 group-data-[cycle=annual]/shell:bg-jade-500/15 group-data-[cycle=annual]/shell:text-jade-300">Annual</button>

            <p class="text-3xl font-semibold text-cream">
                <span class="group-data-[cycle=annual]/shell:hidden">$1,240</span>
                <span class="hidden group-data-[cycle=annual]/shell:inline">$1,041</span>
            </p>
        </div>
    </template>
    VUE;

    $cycleReactCode = <<<'REACT'
    const [billing, setBilling] = useState('monthly');

    return (
        <div className="group/shell" data-cycle={billing}>
            <button type="button" onClick={() => setBilling('monthly')}
                className="rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 group-data-[cycle=monthly]/shell:bg-jade-500/15 group-data-[cycle=monthly]/shell:text-jade-300">Monthly</button>
            <button type="button" onClick={() => setBilling('annual')}
                className="rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 group-data-[cycle=annual]/shell:bg-jade-500/15 group-data-[cycle=annual]/shell:text-jade-300">Annual</button>

            <p className="text-3xl font-semibold text-cream">
                <span className="group-data-[cycle=annual]/shell:hidden">$1,240</span>
                <span className="hidden group-data-[cycle=annual]/shell:inline">$1,041</span>
            </p>
        </div>
    );
    REACT;

    $rowCode = <<<'BLADE'
    <tr>
        <th scope="row" class="sticky left-0 z-10 border-b border-white/5 bg-ink-950 px-4 py-3 align-top font-normal">
            <span class="block text-[13px] text-zinc-300">{{ $row['label'] }}</span>
            @isset($row['note'])
                <span class="mt-0.5 block font-mono text-[10px] text-zinc-600">{{ $row['note'] }}</span>
            @endisset
        </th>

        @foreach ($row['values'] as $index => $value)
            <td @class(['border-b px-4 py-3 align-top', 'border-jade-500/20 bg-jade-500/6' => $tiers[$index]['featured'] ?? false, 'border-white/5' => ! ($tiers[$index]['featured'] ?? false)])>
                @if ($value === true)
                    <svg class="size-3.5 text-jade-400" viewBox="0 0 12 12" fill="none" role="img" aria-label="Included">
                        <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                @elseif ($value === false)
                    <span class="block h-3.5 w-3 border-b border-white/15" role="img" aria-label="Not included"></span>
                @else
                    <span class="text-[13px] text-zinc-400">{{ $value }}</span>
                @endif
            </td>
        @endforeach
    </tr>
    BLADE;

    $rowVueCode = <<<'VUE'
    <tr>
        <th scope="row" class="sticky left-0 z-10 border-b border-white/5 bg-ink-950 px-4 py-3 align-top font-normal">
            <span class="block text-[13px] text-zinc-300">{{ row.label }}</span>
            <span v-if="row.note" class="mt-0.5 block font-mono text-[10px] text-zinc-600">{{ row.note }}</span>
        </th>

        <td
            v-for="(value, index) in row.values"
            :key="index"
            class="border-b px-4 py-3 align-top"
            :class="tiers[index].featured ? 'border-jade-500/20 bg-jade-500/6' : 'border-white/5'"
        >
            <svg v-if="value === true" class="size-3.5 text-jade-400" viewBox="0 0 12 12" fill="none" role="img" aria-label="Included">
                <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span v-else-if="value === false" class="block h-3.5 w-3 border-b border-white/15" role="img" aria-label="Not included"></span>
            <span v-else class="text-[13px] text-zinc-400">{{ value }}</span>
        </td>
    </tr>
    VUE;

    $rowReactCode = <<<'REACT'
    <tr>
        <th scope="row" className="sticky left-0 z-10 border-b border-white/5 bg-ink-950 px-4 py-3 align-top font-normal">
            <span className="block text-[13px] text-zinc-300">{row.label}</span>
            {row.note && <span className="mt-0.5 block font-mono text-[10px] text-zinc-600">{row.note}</span>}
        </th>

        {row.values.map((value, index) => (
            <td key={index} className={`border-b px-4 py-3 align-top ${tiers[index].featured ? 'border-jade-500/20 bg-jade-500/6' : 'border-white/5'}`}>
                {value === true && (
                    <svg className="size-3.5 text-jade-400" viewBox="0 0 12 12" fill="none" role="img" aria-label="Included">
                        <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round"/>
                    </svg>
                )}
                {value === false && <span className="block h-3.5 w-3 border-b border-white/15" role="img" aria-label="Not included" />}
                {typeof value === 'string' && <span className="text-[13px] text-zinc-400">{value}</span>}
            </td>
        ))}
    </tr>
    REACT;

    $dialCode = <<<'BLADE'
    <x-templates.pricing.dial field="api" label="API calls" hint="storefront reads, orders, and webhooks out"
        :min="250" :max="40000" :step="250" :value="8400" format="calls" display="8.4M" />

    <script>
        document.addEventListener('input', (event) => {
            const dial = event.target.closest('[data-calc-field]');

            if (!dial || event.target.type !== 'range') {
                return;
            }

            const input = event.target;
            const format = formats[dial.dataset.calcFormat] ?? formats.number;

            dial.style.setProperty('--ui-slider-fill', ((input.value - input.min) / (input.max - input.min)) * 100 + '%');
            dial.querySelector('[data-calc-output]').textContent = format(Number(input.value));
        });
    </script>
    BLADE;

    $dialVueCode = <<<'VUE'
    <PricingDial
        v-model="usage.api"
        label="API calls"
        hint="storefront reads, orders, and webhooks out"
        :min="250"
        :max="40000"
        :step="250"
        :format="calls"
    />
    VUE;

    $dialReactCode = <<<'REACT'
    <PricingDial
        label="API calls"
        hint="storefront reads, orders, and webhooks out"
        min={250}
        max={40000}
        step={250}
        value={usage.api}
        format={calls}
        onChange={(value) => setUsage({ ...usage, api: value })}
    />
    REACT;

    $rateCode = <<<'BLADE'
    <div class="grid gap-px overflow-hidden rounded-xl border border-white/8 bg-white/8 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($rates as $rate)
            <div class="bg-ink-950 p-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $rate['label'] }}</p>
                <p class="mt-2 font-mono text-lg text-cream">{{ $rate['rate'] }}</p>
                <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $rate['unit'] }}</p>
            </div>
        @endforeach
    </div>
    BLADE;

    $rateVueCode = <<<'VUE'
    <div class="grid gap-px overflow-hidden rounded-xl border border-white/8 bg-white/8 sm:grid-cols-2 lg:grid-cols-4">
        <div v-for="rate in rates" :key="rate.label" class="bg-ink-950 p-4">
            <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ rate.label }}</p>
            <p class="mt-2 font-mono text-lg text-cream">{{ rate.rate }}</p>
            <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ rate.unit }}</p>
        </div>
    </div>
    VUE;

    $rateReactCode = <<<'REACT'
    <div className="grid gap-px overflow-hidden rounded-xl border border-white/8 bg-white/8 sm:grid-cols-2 lg:grid-cols-4">
        {rates.map((rate) => (
            <div key={rate.label} className="bg-ink-950 p-4">
                <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{rate.label}</p>
                <p className="mt-2 font-mono text-lg text-cream">{rate.rate}</p>
                <p className="mt-0.5 font-mono text-[10px] text-zinc-600">{rate.unit}</p>
            </div>
        ))}
    </div>
    REACT;
@endphp

<x-layout title="Pricing template — BLADE-COMPONENTS">
    <div class="mx-auto max-w-6xl px-6 py-16 pb-28">

        <a href="{{ route('templates') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Templates
        </a>

        <div class="rise mt-5 flex flex-wrap items-end justify-between gap-4" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Template</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $template['name'] }}</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    The public side of <span class="text-zinc-300">wharf</span>, the platform the Dashboard, Auth, and Settings templates run.
                    A plan is a fee plus a seat rate plus what you meter, so these four screens show all three instead of a list of ticks.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $template['pages']) }} screens</span>
        </div>

        <nav class="rise sticky top-14 z-30 -mx-6 mt-8 border-y border-white/5 bg-ink-950/85 px-6 py-2.5 backdrop-blur" style="animation-delay: 120ms">
            <ul class="flex flex-wrap items-center gap-1 text-sm">
                @foreach ($screens as $screen)
                    <li>
                        <a href="#{{ $screen['slug'] }}" data-spy-link
                            class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">{{ $screen['name'] }}</a>
                    </li>
                @endforeach
                <li class="ml-auto flex items-center gap-1">
                    <a href="#blocks" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Blocks</a>
                    <a href="#install" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Installation</a>
                </li>
            </ul>
        </nav>

        <section class="mt-10">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Screens</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Live, not screenshots. Flip the monthly and annual switch in any of them and every price on that screen follows.</p>

            <div class="mt-6 flex flex-col gap-10">
                @foreach ($screens as $screen)
                    <x-screen-preview
                        :id="$screen['slug']"
                        data-spy-section
                        class="scroll-mt-32"
                        :title="$screen['name']"
                        :description="$screen['description']"
                        :href="route('templates.screen', [$template['slug'], $screen['slug']])"
                        :panels="$sourcesFor($screen['slug'])">
                        <x-dynamic-component :component="'templates.'.$template['slug'].'.'.$screen['slug']" />
                    </x-screen-preview>
                @endforeach
            </div>
        </section>

        <section id="blocks" data-spy-section class="mt-16 scroll-mt-32">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Blocks</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The parts the four screens are assembled from. Take one, take all of them.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Plan card" padding="p-8"
                    description="A name, a price that answers to the cycle switch, one line of what a seat costs, and features written as quantities rather than adjectives."
                    :code="$cardCode" :vue-code="$cardVueCode" :react-code="$cardReactCode">
                    <div class="w-full max-w-sm">
                        <x-templates.pricing.plan-card
                            name="Scale"
                            badge="68% of merchants"
                            featured
                            tagline="Every storefront you run, priced per seat, metered above the included line."
                            monthly="$1,240"
                            annual="$1,041"
                            unit="+ $12 per seat, minimum of 10"
                            annual-note="$12,492 billed once · saves $2,388"
                            cta="Start on Scale"
                            cta-variant="primary"
                            meta="99.95% SLA with credits · plan changes prorate to the day"
                            :features="$demoFeatures" />
                    </div>
                </x-demo>

                <x-demo title="Billing cycle switch" padding="p-8"
                    description="One data attribute on the shell, read by every price through a named group. No price is duplicated in JavaScript, and the markup stays legible."
                    :code="$cycleCode" :vue-code="$cycleVueCode" :react-code="$cycleReactCode">
                    <div class="group/shell flex w-full max-w-sm flex-col items-center gap-5" data-cycle="monthly">
                        <div class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-ink-950 p-1">
                            <button type="button" data-cycle-set="monthly"
                                class="rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 group-data-[cycle=monthly]/shell:bg-jade-500/15 group-data-[cycle=monthly]/shell:text-jade-300 hover:text-cream">Monthly</button>
                            <button type="button" data-cycle-set="annual"
                                class="inline-flex items-center gap-2 rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 group-data-[cycle=annual]/shell:bg-jade-500/15 group-data-[cycle=annual]/shell:text-jade-300 hover:text-cream">
                                Annual
                                <span class="font-mono text-[10px] text-jade-400">−16%</span>
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-3xl font-semibold tracking-tight text-cream">
                                <span class="group-data-[cycle=annual]/shell:hidden">$1,240</span>
                                <span class="hidden group-data-[cycle=annual]/shell:inline">$1,041</span>
                                <span class="font-mono text-xs font-normal text-zinc-600">/ mo</span>
                            </p>
                            <p class="mt-2 font-mono text-[11px] text-zinc-600">
                                <span class="group-data-[cycle=annual]/shell:hidden">billed on the 1st, cancel any time</span>
                                <span class="hidden group-data-[cycle=annual]/shell:inline">$12,492 billed once · saves $2,388</span>
                            </p>
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Comparison row" padding="p-8"
                    description="A tick means included, a short rule means not, and anything with a number says the number. The row label sticks to the left edge while the table scrolls."
                    :code="$rowCode" :vue-code="$rowVueCode" :react-code="$rowReactCode">
                    <div class="w-full max-w-xl overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <table class="w-full border-separate border-spacing-0 text-left">
                            <tbody>
                                <tr>
                                    <th scope="row" class="w-1/2 border-b border-white/5 px-4 py-3 align-top font-normal">
                                        <span class="block text-[13px] text-zinc-300">API calls</span>
                                        <span class="mt-0.5 block font-mono text-[10px] text-zinc-600">then $0.40 per extra 10k</span>
                                    </th>
                                    <td class="border-b border-white/5 px-4 py-3 align-top"><span class="text-[13px] text-zinc-400">250k / mo</span></td>
                                    <td class="border-b border-jade-500/20 bg-jade-500/6 px-4 py-3 align-top"><span class="text-[13px] text-zinc-400">12M / mo</span></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="px-4 py-3 align-top font-normal">
                                        <span class="block text-[13px] text-zinc-300">SAML SSO</span>
                                    </th>
                                    <td class="px-4 py-3 align-top">
                                        <span class="block h-3.5 w-3 border-b border-white/15" role="img" aria-label="Not included"></span>
                                    </td>
                                    <td class="bg-jade-500/6 px-4 py-3 align-top">
                                        <svg class="size-3.5 text-jade-400" viewBox="0 0 12 12" fill="none" role="img" aria-label="Included">
                                            <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </x-demo>

                <x-demo title="Usage dial" padding="p-8"
                    description="A range input with the readout in the unit a buyer thinks in — 8.4M, not 8400. The fill is a CSS variable so nothing repaints on drag."
                    :code="$dialCode" :vue-code="$dialVueCode" :react-code="$dialReactCode">
                    <div class="w-full max-w-sm rounded-xl border border-white/8 bg-ink-950 p-5">
                        <x-templates.pricing.dial field="demo-api" label="API calls" hint="storefront reads, orders, and webhooks out"
                            :min="250" :max="40000" :step="250" :value="8400" format="calls" display="8.4M" />
                    </div>
                </x-demo>

                <x-demo title="Metered rate grid" padding="p-8"
                    description="What each unit costs once an included limit is crossed. Four cells, hairlines painted by the gap, no cell owning a border."
                    :code="$rateCode" :vue-code="$rateVueCode" :react-code="$rateReactCode">
                    <div class="grid w-full gap-px overflow-hidden rounded-xl border border-white/8 bg-white/8 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($demoRates as $rate)
                            <div class="bg-ink-950 p-4">
                                <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $rate['label'] }}</p>
                                <p class="mt-2 font-mono text-lg text-cream">{{ $rate['rate'] }}</p>
                                <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $rate['unit'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[['slug' => 'shell', 'name' => 'Pricing shell'], ['slug' => 'plan-card', 'name' => 'Plan card'], ['slug' => 'dial', 'name' => 'Usage dial']]"
            description="Every screen carries its own source under its preview. These three are what all four share — the shell holds the billing cycle, so paste it first."
            :components="['button', 'separator', 'input', 'textarea', 'select', 'checkbox', 'slider', 'scroll-top']" />
    </div>
</x-layout>
