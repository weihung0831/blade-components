@php
    $plans = [
        [
            'name' => 'Launch',
            'tagline' => 'One storefront, one region, and the same API the large accounts run on.',
            'monthly' => '$79',
            'annual' => '$66',
            'unit' => '+ $6 per seat after the first 5',
            'annualNote' => '$792 billed once · saves $156',
            'cta' => 'Start a 14-day trial',
            'ctaVariant' => 'secondary',
            'features' => [
                ['label' => '1 storefront', 'meta' => '+ 2 sandboxes'],
                ['label' => '5 seats included'],
                ['label' => '250k API calls', 'meta' => 'per month'],
                ['label' => '50 GB assets · 250 GB bandwidth'],
                ['label' => 'ap-1 only', 'meta' => 'no data residency clause'],
                ['label' => 'Email support', 'meta' => 'next business day'],
            ],
            'meta' => '99.9% uptime target, no SLA credits · card required when the trial ends',
        ],
        [
            'name' => 'Scale',
            'badge' => '68% of merchants',
            'featured' => true,
            'tagline' => 'Every storefront you run, priced per seat, metered above the included line.',
            'monthly' => '$1,240',
            'annual' => '$1,041',
            'unit' => '+ $12 per seat, minimum of 10',
            'annualNote' => '$12,492 billed once · saves $2,388',
            'cta' => 'Start on Scale',
            'ctaVariant' => 'primary',
            'features' => [
                ['label' => 'Unlimited storefronts', 'meta' => '+ 10 sandboxes'],
                ['label' => '12M API calls', 'meta' => 'then $0.40 per 10k'],
                ['label' => '1 TB assets · 5 TB bandwidth'],
                ['label' => 'Three regions', 'meta' => 'ap-1 · sfo-2 · fra-1'],
                ['label' => 'SAML SSO and audit log', 'meta' => '1 year retention'],
                ['label' => 'Priority support', 'meta' => '4h first response'],
            ],
            'meta' => '99.95% SLA with credits · plan changes prorate to the day',
        ],
        [
            'name' => 'Enterprise',
            'badge' => 'From 500 seats',
            'tagline' => 'Your own region, your own paperwork, and a seat rate we agree on.',
            'monthly' => 'Custom',
            'period' => '',
            'unit' => 'Quoted per seat, floor of 500',
            'cta' => 'Talk to sales',
            'ctaVariant' => 'secondary',
            'features' => [
                ['label' => 'Dedicated region', 'meta' => 'VPC peering, private link'],
                ['label' => 'Quotas set in the contract', 'meta' => 'nothing meters into an invoice'],
                ['label' => 'SCIM provisioning, custom roles'],
                ['label' => 'Audit log', 'meta' => '7 years, exportable'],
                ['label' => 'Named solutions engineer'],
                ['label' => 'MSA, DPA, PO invoicing', 'meta' => 'net-30'],
            ],
            'meta' => '99.99% SLA · security review returned inside 10 business days',
        ],
    ];

    $rates = [
        ['label' => 'API calls', 'rate' => '$0.40', 'unit' => 'per extra 10k'],
        ['label' => 'Asset storage', 'rate' => '$0.09', 'unit' => 'per extra GB'],
        ['label' => 'Bandwidth', 'rate' => '$0.05', 'unit' => 'per extra GB'],
        ['label' => 'Webhook events', 'rate' => '$2.00', 'unit' => 'per extra 100k'],
    ];

    $included = [
        'REST and GraphQL',
        'Webhooks with replay',
        'Test-mode payments',
        'Sandbox storefronts',
        'SOC 2 Type II',
        'GDPR and DPA',
        '30-day log retention',
        'No card for the trial',
    ];
@endphp

<x-templates.pricing.shell active="Plans" title="Priced the way a platform bills: a fee, a seat rate, and what you actually move."
    description="Three tiers. The metered part sits above the line and only starts once a limit is crossed — you will see it coming twice before it lands on an invoice.">
    <div class="grid gap-5 lg:grid-cols-3">
        @foreach ($plans as $plan)
            <x-templates.pricing.plan-card
                :name="$plan['name']"
                :tagline="$plan['tagline']"
                :monthly="$plan['monthly']"
                :annual="$plan['annual'] ?? null"
                :period="$plan['period'] ?? '/ mo'"
                :annual-note="$plan['annualNote'] ?? null"
                :unit="$plan['unit']"
                :cta="$plan['cta']"
                :cta-variant="$plan['ctaVariant']"
                :badge="$plan['badge'] ?? null"
                :features="$plan['features']"
                :meta="$plan['meta']"
                :featured="$plan['featured'] ?? false" />
        @endforeach
    </div>

    <section class="mt-12 rounded-2xl border border-white/8 bg-ink-900 p-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h2 class="text-base font-medium text-cream">Metered on top of the plan</h2>
                <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                    Same rates on Launch and Scale. Usage alerts fire at 80% and 95% of an included limit, and the overage lands on the next invoice, not the card on file.
                </p>
            </div>
            <a href="{{ route('templates.screen', ['pricing', 'calculator']) }}" target="_top"
                class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Run the numbers →</a>
        </div>

        <div class="mt-6 grid gap-px overflow-hidden rounded-xl border border-white/8 bg-white/8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($rates as $rate)
                <div class="bg-ink-950 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $rate['label'] }}</p>
                    <p class="mt-2 font-mono text-lg text-cream">{{ $rate['rate'] }}</p>
                    <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $rate['unit'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mt-12">
        <div class="flex flex-wrap items-baseline gap-x-4 gap-y-1">
            <h2 class="text-base font-medium text-cream">In every plan, including the trial</h2>
            <span class="font-mono text-[11px] text-zinc-600">nothing here is an upsell</span>
        </div>

        <div class="mt-4 flex flex-wrap gap-1.5">
            @foreach ($included as $feature)
                <span class="rounded-full border border-white/8 px-2.5 py-1 font-mono text-[11px] text-zinc-500">{{ $feature }}</span>
            @endforeach
        </div>
    </section>

    <section class="mt-12 grid gap-5 sm:grid-cols-2">
        <div class="rounded-2xl border border-white/8 bg-ink-900 p-6">
            <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Moving between plans</p>
            <p class="mt-3 text-[13px]/6 text-zinc-400">
                Upgrades take effect the moment you confirm and prorate to the day. Downgrades wait for the renewal date so you keep what you paid for.
                Seats added mid-cycle are charged for the days they exist.
            </p>
            <a href="{{ route('templates.screen', ['settings', 'billing']) }}" target="_top"
                class="mt-4 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">See it on a real invoice →</a>
        </div>

        <div class="rounded-2xl border border-white/8 bg-ink-900 p-6">
            <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Leaving</p>
            <p class="mt-3 text-[13px]/6 text-zinc-400">
                Cancel and the workspace runs to the end of the cycle, then goes read-only for 30 days. Catalog, orders, and logs export as CSV or through the API the whole time.
                We do not hold data hostage to a renewal.
            </p>
            <a href="#" class="mt-4 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Export formats →</a>
        </div>
    </section>
</x-templates.pricing.shell>
