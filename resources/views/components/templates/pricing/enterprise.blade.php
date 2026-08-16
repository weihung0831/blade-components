@php
    $regions = [
        ['label' => 'ap-1', 'meta' => 'Taipei', 'checked' => true],
        ['label' => 'sfo-2', 'meta' => 'San Jose', 'checked' => false],
        ['label' => 'fra-1', 'meta' => 'Frankfurt', 'checked' => false],
        ['label' => 'Dedicated', 'meta' => 'your VPC', 'checked' => false],
    ];

    $procurement = [
        ['label' => 'MSA redlines', 'description' => 'Our paper or yours'],
        ['label' => 'DPA and SCCs', 'description' => 'Signed before the trial data moves'],
        ['label' => 'PO invoicing, net-30', 'description' => 'PO number prints above the line items'],
        ['label' => 'Security questionnaire', 'description' => 'Returned inside 10 business days'],
    ];

    $credits = [
        ['range' => 'below 99.99%', 'credit' => '10%'],
        ['range' => 'below 99.9%', 'credit' => '25%'],
        ['range' => 'below 99.5%', 'credit' => '50%'],
        ['range' => 'below 99.0%', 'credit' => '100%'],
    ];

    $security = [
        ['label' => 'SOC 2 Type II', 'meta' => 'report on request, NDA first'],
        ['label' => 'ISO 27001', 'meta' => 'certified through 2027'],
        ['label' => 'Penetration test', 'meta' => 'twice a year, summary shared'],
        ['label' => 'Sub-processors', 'meta' => '11, listed with 30 days notice'],
        ['label' => 'Encryption', 'meta' => 'AES-256 at rest, TLS 1.3 in transit'],
        ['label' => 'Bug bounty', 'meta' => 'open, paid, no scope games'],
    ];

    $steps = [
        ['label' => 'Scoping call', 'time' => '45 min', 'detail' => 'Seats, regions, and what the migration actually contains. An engineer is on it, not only sales.'],
        ['label' => 'Quote and paper', 'time' => '3 days', 'detail' => 'A rate held for 30 days, the MSA, and the security pack in one thread.'],
        ['label' => 'Migration and cutover', 'time' => '3 weeks typical', 'detail' => 'Sandbox first, dual-write second, DNS last. A named engineer stays for the first month.'],
    ];
@endphp

<x-templates.pricing.shell active="Enterprise" :cycle="false"
    title="Past 500 seats, the price stops being a list and starts being a conversation."
    description="Tell us the shape of the workspace. You get a rate held for 30 days, the security pack, and the contract in the same thread — no demo required to see any of it.">
    <div class="grid gap-6 lg:grid-cols-5">
        <section class="rounded-2xl border border-white/8 bg-ink-900 p-6 lg:col-span-3">
            <h2 class="text-base font-medium text-cream">Request a quote</h2>
            <p class="mt-1.5 text-[13px]/6 text-zinc-500">Two answers set most of the price: how many seats, and how many regions.</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <x-ui.input label="Work email" type="email" name="email" placeholder="you@company.com" />
                <x-ui.input label="Company" name="company" placeholder="Northbeam Supply" />
                <div>
                    <p class="mb-1.5 text-[13px] text-zinc-400">Seats</p>
                    <x-ui.select name="seats" value="500 – 1,000" :options="['500 – 1,000', '1,000 – 5,000', 'More than 5,000']" />
                </div>

                <div>
                    <p class="mb-1.5 text-[13px] text-zinc-400">Live storefronts</p>
                    <x-ui.select name="storefronts" value="6 – 20" :options="['1 – 5', '6 – 20', 'More than 20']" />
                </div>
            </div>

            <div class="mt-6">
                <p class="mb-2 text-[13px] text-zinc-400">Regions</p>
                <div class="grid gap-2 sm:grid-cols-2">
                    @foreach ($regions as $region)
                        <x-ui.checkbox variant="card" name="regions[]" :label="$region['label']" :description="$region['meta']" :checked="$region['checked']" />
                    @endforeach
                </div>
            </div>

            <div class="mt-6">
                <p class="mb-2 text-[13px] text-zinc-400">What procurement will need</p>
                <div class="flex flex-col gap-2.5">
                    @foreach ($procurement as $item)
                        <x-ui.checkbox name="procurement[]" :label="$item['label']" :description="$item['description']" />
                    @endforeach
                </div>
            </div>

            <div class="mt-6">
                <x-ui.textarea label="Anything else" name="notes" rows="3"
                    placeholder="Current platform, migration deadline, the clause your legal team always asks for." />
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-x-4 gap-y-3">
                <x-ui.button>Send it</x-ui.button>
                <p class="font-mono text-[11px] text-zinc-600">A person replies within one business day, in your timezone.</p>
            </div>
        </section>

        <div class="flex flex-col gap-6 lg:col-span-2">
            <section class="rounded-2xl border border-white/8 bg-ink-900 p-6">
                <div class="flex items-baseline justify-between gap-3">
                    <h2 class="text-base font-medium text-cream">99.99% SLA</h2>
                    <span class="font-mono text-[10px] text-zinc-600">measured monthly</span>
                </div>
                <p class="mt-2 text-[13px]/6 text-zinc-500">Credits are automatic. You do not have to notice the outage and file for them.</p>

                <ul class="mt-4 flex flex-col divide-y divide-white/5 border-t border-white/5">
                    @foreach ($credits as $credit)
                        <li class="flex items-baseline justify-between gap-3 py-2">
                            <span class="font-mono text-[11px] text-zinc-500">{{ $credit['range'] }}</span>
                            <span class="font-mono text-[13px] text-jade-400">{{ $credit['credit'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="rounded-2xl border border-white/8 bg-ink-900 p-6">
                <h2 class="text-base font-medium text-cream">Security</h2>

                <ul class="mt-4 flex flex-col gap-3">
                    @foreach ($security as $item)
                        <li>
                            <p class="text-[13px] text-zinc-300">{{ $item['label'] }}</p>
                            <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $item['meta'] }}</p>
                        </li>
                    @endforeach
                </ul>

                <a href="#" class="mt-5 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Trust centre →</a>
            </section>
        </div>
    </div>

    <section class="mt-6 rounded-2xl border border-white/8 bg-ink-900 p-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h2 class="text-base font-medium text-cream">What happens after you send it</h2>
                <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">Three steps, and the longest one is the migration you are already planning.</p>
            </div>
            <span class="font-mono text-[11px] text-zinc-600">last 12 quotes averaged 4.2 days to signature</span>
        </div>

        <ol class="mt-6 grid gap-px overflow-hidden rounded-xl border border-white/8 bg-white/8 sm:grid-cols-3">
            @foreach ($steps as $step)
                <li class="bg-ink-950 p-5">
                    <div class="flex items-baseline gap-2">
                        <span class="font-mono text-[11px] text-jade-400">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <span class="text-[13px] text-zinc-200">{{ $step['label'] }}</span>
                        <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ $step['time'] }}</span>
                    </div>
                    <p class="mt-2.5 text-[13px]/6 text-zinc-500">{{ $step['detail'] }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    <section class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3 rounded-2xl border border-white/8 bg-ink-900 px-6 py-5">
        <p class="text-[13px]/6 text-zinc-400">Under 500 seats? The self-serve plans cost less than anything we would quote you.</p>
        <div class="ml-auto flex flex-wrap items-center gap-4">
            <a href="{{ route('templates.screen', ['pricing', 'plans']) }}" target="_top"
                class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Back to plans →</a>
            <a href="{{ route('templates.screen', ['pricing', 'calculator']) }}" target="_top"
                class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Estimate it →</a>
        </div>
    </section>
</x-templates.pricing.shell>
